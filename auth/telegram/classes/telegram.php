<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace auth_telegram;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');
require_once($CFG->dirroot.'/user/lib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');

use stdClass;
use coding_exception;
use dml_exception;

/**
 * Class telegram
 *
 * @package    auth_telegram
 * @copyright  2024 Wail Abualela <wailabualela@email.com>
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class telegram
{
    /**
     * create a new user
     * @param array $data
     * @return stdClass
     */
    public static function create_user($data): stdClass {
        global $CFG, $DB;

        $user                    = new stdClass();
        $user->auth              = "telegram";
        $user->username          = $data['id']; // Use telegram ID as username
        $user->firstname         = $data['first_name'] ?? 'Unknown';
        $user->lastname          = $data['last_name'] ?? '';
        $user->confirmed         = 1;
        $user->mnethostid        = 1;
        $user->firstaccess       = time();
        $user->timecreated       = time();
        $user->lastlogin         = time();
        $user->lastaccess        = time();
        $user->currentlogin      = time();
        $user->lastip            = getremoteaddr();
        $user->password          = ''; // No password for telegram auth
        $user->email             = $data['email'] ?? $data['id'] . '@telegram.local';
        $user->phone1            = $data['phone_number'] ?? '';
        $user->calendartype      = $CFG->calendartype;
        $user->firstnamephonetic = '';
        $user->lastnamephonetic  = '';
        $user->middlename        = '';
        $user->alternatename     = '';
        $user->lang              = $CFG->lang;
        $user->timezone          = $CFG->timezone;

        try {
            $user->id = user_create_user($user, false, false);

            profile_save_data($user);

            if (!empty($data['photo_url'])) {
                self::update_picture($user, $data['photo_url']);
            }

            return $user;
        } catch (Exception $e) {
            throw new \moodle_exception('usercreationfailed', 'auth_telegram', '', null, $e->getMessage());
        }
    }

    /**
     * Check if a user exists for the provided Telegram identifier.
     *
     * @param string $telegramid Telegram user ID used as the Moodle username.
     * @return bool True if the user exists, false otherwise.
     */
    public static function user_exists($telegramid): bool {
        global $DB;
        return $DB->record_exists(
            'user',
            array(
                'username'  => $telegramid,
                'deleted'   => false,
                'confirmed' => true,
            ),
        );
    }


    /**
     * Retrieve a user by Telegram identifier used as username.
     *
     * @param string $telegramid Telegram user ID used as the Moodle username.
     * @return stdClass User record matching the Telegram ID.
     */
    public static function get_user($telegramid): stdClass {
        global $DB;
        $user = $DB->get_record(
            'user',
            array(
                'username'  => $telegramid,
                'deleted'   => false,
                'confirmed' => true,
            ),
        );
        
        if (!$user) {
            throw new \moodle_exception('usernotfound', 'auth_telegram', '', $telegramid);
        }
        
        return $user;
    }

    /**
     * authenticate the user
     * @param \stdClass $user
     * @param string $wantsurl
     * @throws \Exception
     * @return void
     */
    public static function user_login($user, $wantsurl = null) {
        complete_user_login($user);
        \core\session\manager::apply_concurrent_login_limit($user->id, session_id());

        if ($wantsurl) {
            redirect($wantsurl);
        } else {
            redirect('/');
        }
    }

    /**
     * Get a static user picture.
     *
     * @return string|null Base64 encoded image data or null if no image is available.
     */
    public static function update_picture($user, $photoUrl): bool {
        global $CFG, $DB, $USER;

        // Only proceeds if:
        // - User doesn't already have a picture
        // - Gravatar is not enabled
        // - A picture was provided by OAuth
        if (!empty($user->picture) || !empty($CFG->enablegravatar)) {
            return false;
        }

        $picture = $photoUrl;
        if (empty($picture)) {
            return false;
        }

        // Create temporary storage for the new image
        $context = \context_user::instance($user->id);
        $fs      = get_file_storage();
        $fs->delete_area_files($context->id, 'user', 'newicon');

        // Store the image data in a file
        $filerecord = array(
            'contextid' => $context->id,
            'component' => 'user',
            'filearea'  => 'newicon',
            'itemid'    => 0,
            'filepath'  => '/',
            'filename'  => 'image'
        );

        // Process the image and set it as user's picture
        try {
            $fs->create_file_from_string($filerecord, $picture);
            // Get file and process it
            $iconfile = $fs->get_area_files($context->id, 'user', 'newicon', false, 'itemid', false);
            $iconfile = reset($iconfile);
            $iconfile = $iconfile->copy_content_to_temp();

            // Process the image into proper user icon format
            $newpicture = (int) process_new_icon($context, 'user', 'icon', 0, $iconfile);

            // Clean up temporary files
            @unlink($iconfile);
            $fs->delete_area_files($context->id, 'user', 'newicon');

            // Update user record with new picture ID
            $updateuser          = new stdClass();
            $updateuser->id      = $user->id;
            $updateuser->picture = $newpicture;
            $USER->picture       = $newpicture;
            user_update_user($updateuser);
            return true;
        } catch (\file_exception $e) {
            return get_string($e->errorcode, $e->module, $e->a);
        }
    }

}
