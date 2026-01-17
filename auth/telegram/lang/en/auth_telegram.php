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
 * Strings for component 'auth_telegram', language 'en'.
 *
 * @package    auth_telegram
 * @copyright  2023 Mortada ELgaily <mortada.elgaily@gmail.com>
 * @copyright  2025 Your Name <your.email@example.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['botusername']           = 'Bot username';
$string['botusername_help']      = 'Telegram bot username ';
$string['pluginname']            = 'Telegram';
$string['telegrambottoken']      = 'Bot token';
$string['telegrambottoken_help'] = 'Telegram bot token ';
$string['hello']                 = 'Hello World';
$string['notenabled']            = 'Sorry, Telegram authentication plugin is not enabled';
$string['missingtelegramid']     = 'Missing telegramid';
$string['missingfieldsheader']   = 'Additional profile information required';
$string['missingfieldsmessage']  = 'Please fill in the following required profile fields to continue:';
$string['setupinstructions']     = '<h3>How to set up Telegram Bot for authentication:</h3><ol><li>Talk to <a href="https://t.me/BotFather" target="_blank">@BotFather</a> on Telegram</li><li>Send command: <code>/newbot</code></li><li>Follow the instructions to create a new bot</li><li>After creation, you will receive a token - copy it</li><li>Go to your bot profile and click "Edit" -> "Bot Settings" -> "Allow connected websites"</li><li>Add your Moodle site domain to the allowed domains list</li><li>Enter the bot username and token in the fields above</li></ol>';
$string['autocreate']            = 'Auto-create users';
$string['autocreate_help']       = 'If enabled, new users will be automatically created when logging in via Telegram. Otherwise, only existing users can log in.';
