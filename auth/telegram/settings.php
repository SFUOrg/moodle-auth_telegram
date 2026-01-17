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

/**
 * Admin settings and defaults
 * @package    auth_telegram
 * @copyright  2021 Brain Station 23 ltd
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_heading('auth_telegram/security',
        new lang_string('security', 'admin'), get_string('pluginname', 'auth_telegram')));
        
    $settings->add(new admin_setting_configtext('auth_telegram/botusername',
            get_string('botusername', 'auth_telegram'),
            get_string('botusername_help', 'auth_telegram'), '', PARAM_TEXT));

    $settings->add(new admin_setting_configtext('auth_telegram/bottoken',
        get_string('telegrambottoken', 'auth_telegram'),
        get_string('telegrambottoken_help', 'auth_telegram'), '', PARAM_TEXT));
        
    // Add description about how to set up Telegram bot
    $settings->add(new admin_setting_heading('auth_telegram/setupinfo',
        new lang_string('info', 'admin'), 
        get_string('setupinstructions', 'auth_telegram')));

    // Auto-create user setting
    $settings->add(new admin_setting_configcheckbox('auth_telegram/autocreate',
        get_string('autocreate', 'auth_telegram'),
        get_string('autocreate_help', 'auth_telegram'), 1));
}
