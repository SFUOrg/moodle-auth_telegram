**Moodle Authentication Plugin with Telegram Login Widget**

Welcome to the enhanced Moodle Authentication Plugin with Telegram Login Widget! This plugin allows you to integrate Telegram's secure login functionality directly into your Moodle platform, providing users with a convenient and secure authentication method. This README provides instructions on how to install the plugin, configure Telegram authentication settings, and set up a Telegram bot for authentication purposes.

**New Features Added:**
- Compatibility with Moodle 4.1.21
- Auto-create user option (admin can enable/disable user auto-creation)
- Email uniqueness validation
- Improved error handling and user feedback
- Enhanced security with proper session management
- Better integration with Moodle's authentication system
- Support for custom profile fields during registration

**Installation Steps:**

1. **Download the Plugin:**

   - Clone the repository or download the plugin ZIP file from the GitHub repository.

2. **Upload to Moodle:**

   - Upload the plugin folder to the `auth` directory in your Moodle installation directory.

3. **Install the Plugin:**

   - Log in to your Moodle site as an administrator.
   - Navigate to **Site Administration** > **Plugins** > **Install plugins**.
   - Drag and drop the ZIP file containing the plugin or choose the file manually.
   - Follow the on-screen instructions to complete the installation process.

4. **Enable Telegram Authentication:**

   - After installation, navigate to **Site Administration** > **Plugins** > **Authentication** > **Manage authentication**.
   - Enable the "Telegram" authentication method.

5. **Configure Telegram Authentication:**

   - Click on **Settings** next to the Telegram authentication method.
   - Enter your Telegram bot's username and secret key in the designated fields.
   - Configure the auto-create user setting as needed.
   - Save the settings.

**Setting Up Telegram Bot:**

1. **Create a Telegram Bot:**

   - Open the Telegram app and search for the "@BotFather" user.
   - Start a conversation with BotFather and send the command `/newbot`.
   - Follow the prompts to create a new bot.
   - Note down the bot's username and token provided by BotFather.

2. **Configure Bot Permissions:**

   - Go to your bot profile and click "Edit" -> "Bot Settings" -> "Allow connected websites".
   - Add your Moodle site domain to the allowed domains list.

3. **Configure Moodle Plugin:**

   - In the Moodle plugin settings, enter your bot's username and token in the designated fields.

**Usage:**

Once the plugin is installed and configured, users can log in to Moodle using their Telegram accounts. They will be prompted to authorize the Telegram bot for authentication purposes. After authorization, users can seamlessly log in to Moodle using their Telegram credentials.

If auto-create is enabled, new users will be automatically created. Otherwise, only existing users can log in via Telegram.

**Feedback and Support:**

If you encounter any issues during installation or have any questions about the plugin, please don't hesitate to reach out to our support team or submit a GitHub issue. We value your feedback and are committed to providing ongoing support to ensure a smooth experience with our plugin.

Thank you for choosing our enhanced Moodle Authentication Plugin with Telegram Login Widget. We hope this plugin enhances your Moodle platform's authentication experience for both administrators and users alike.
