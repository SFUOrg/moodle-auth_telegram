Telegram Authentication Plugin for Moodle
==========================================

This plugin enables authentication through Telegram for Moodle users.

Features:
- Login via Telegram
- Automatic user creation
- Profile synchronization

Installation:
1. Copy the auth/telegram folder to your Moodle's auth directory
2. Log into Moodle as administrator
3. Go to Site administration > Notifications to install the plugin
4. Configure the plugin at Site administration > Plugins > Authentication > Telegram

Configuration:
- Bot Token: Your Telegram bot token from @BotFather
- Bot Username: Your Telegram bot username (without @)
- Auto-create users: Whether to create new accounts for first-time users

For help setting up a Telegram bot, see the plugin settings page after installation.

Requirements:
- Moodle 4.0 or higher
- Telegram Bot API token