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

defined('MOODLE_INTERNAL') || die();

/**
 * Telegram authentication plugin.
 * @package    auth_telegram
 * @copyright  2023 Mortada ELgaily <mortada.elgaily@gmail.com>
 * @copyright  2024 Wail Abualela <wailabualela@email.com>
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_plugin_telegram extends \auth_telegram\auth
{
    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    public function user_login($username, $password) {
        global $DB;

        // Telegram authentication doesn't use passwords.
        // Instead, we check if the user exists in the database.
        if ($user = $DB->get_record('user', ['username' => $username])) {
            return true;
        }
        
        return false;
    }

    /**
     * Indicates if password hashes should be saved.
     *
     * @return bool
     */
    public function prevent_local_passwords() {
        return true;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    public function can_change_password() {
        return false;
    }

    /**
     * Returns the URL for changing the user's password or null if the default
     * change password page should be used.
     *
     * @return moodle_url|null
     */
    public function change_password_url() {
        return null;
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    public function is_internal() {
        return false;
    }

    /**
     * Returns true if plugin can be manually set.
     *
     * @return bool
     */
    public function can_be_manually_set() {
        return true;
    }

    /**
     * Pre-user creation hook.
     *
     * @param stdClass $user The user object that is going to be created
     * @return bool
     */
    public function pre_user_create(&$user) {
        // Set authentication method to telegram.
        $user->auth = 'telegram';
        return true;
    }
}
