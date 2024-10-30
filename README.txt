=== Lazy load videos and sticky control ===
Tags: lazyload, youtube, shortcode, content, video, floating video, sticky video
Requires at least: 4.4
Tested up to: 6.5.4
Stable tag: 3.0.0
Requires PHP: 5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lazy load and sticky your video. Super-easy and fun! 

== Description ==
This plugin enhances page load times by loading only the YouTube video preview image initially. Additionally, it offers the option to make your video sticky, positioning it at the top or bottom of the window when the user scrolls away from the video viewport.

== Features ==
- **Lazy Load Videos:** Reduce the amount of time it takes to load your video by loading just the video thumbnail.
- **Multiple Video Support:** You may quickly and simply add more than one video to a page. Videos can only be played one at a time, and when one is playing, the other one instantly pauses.
- **Sticky Video:** Keep videos visible as you navigate by adhering them to the top or bottom of the screen to ensure ongoing playback.
- **Custom Styling:** Adapt your videos' look to perfectly match the style of your website by using your own CSS.

== Usage ==

### Method 1: Using the Classic Editor (WP Editor)

1. **Generate Shortcode in WP Editor:**
    - Open the post/page where you want to add the YouTube video.
    - In the WordPress editor, click on the **LLVASC** icon. This will open a popup window.
    - In the popup, add your YouTube video ID. The video ID is the unique alphanumeric code found at the end of your YouTube video URL. For example, in `https://www.youtube.com/watch?v=iXGoAj7IEys`, the video ID is `iXGoAj7IEys`.
    - After entering the video ID, click "Ok". This action will generate and insert a shortcode into your content.

2. **Shortcode Format:**
    - The shortcode added to your content will look like this: 
      `[lazy-load-videos-and-sticky-control id="Youtube-video-ID"]`
    - For example, if your video ID is `iXGoAj7IEys`, the shortcode will be:
      `[lazy-load-videos-and-sticky-control id="iXGoAj7IEys"]`

3. **Save/Update:**
    - Save or update your post/page to apply the changes.

4. **Preview and Customize:**
    - Preview your page to see the embedded video.
    - If you need to adjust the styling, you can add custom CSS in the General tab of the plugin settings.

### Method 2: Using Gutenberg Block

1. **Add a Block:**
    - Open the post/page where you want to add the YouTube video using the Gutenberg editor.
    - Click on the “+” icon to add a new block.

2. **Select the ***LLVASC*** Block:**
    - Search for the "LLVASC" block in the block library.
    - Add this block to your content.

3. **Enter YouTube Video ID:**
    - In the LLVASC block settings inspect control, select your video platform and enter your video ID. For example, if your YouTube video URL is `https://www.youtube.com/watch?v=iXGoAj7IEys`, the video ID is `iXGoAj7IEys`.

4. **Save/Update:**
    - Save or update your post/page to apply the changes.

5. **Preview and Customize:**
    - Preview your page to see the embedded video.
    - Customize the block settings as needed to adjust the appearance and functionality.
 
== Demo Preview ==
[Demo](https://preview-plugin.web.app/lazy-load-videos-and-sticky-control.html)

== Installation ==

###  Automatic installation 

1. Open WordPress admin, go to Plugins, click Add New
2. Enter "Lazy load videos and sticky control" in search and hit Enter
3. Plugin will show up as the first on the list, click "Install Now"
4. Activate & open plugin's settings page located under the Settings menu

###  Manual installation 
1. Upload the plugin folder to the `/wp-content/plugins/` directory via ftp
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Does this plugin support multiple videos on a single page?
Yes

= Does using an iframe affect page load time?
Definitely. iframes can affect page load performance, and it is not recommended to use them if you are concerned about your site's speed.

= How do this plugin acheive lazy load?
Instead of loading the iframe of your videos on page load, it only loads the iframe's video preview image.

= Will the plugin lazy load all my existing videos after installation? 
No, you need update your video following above two methods.

= What is sticky control?
Sticky control allows you to change the position of the sticky video from the backend. The available positions are "Bottom Right," "Bottom Left," "Top Right," and "Top Left" of your window.

= Do it support single video playback if i have multiple videos on a page?
Yes, it plays only one video at a time. The previously playing video will pause if you play another video.

= How do I apply custom CSS? 
Once the plugin is installed and activated, navigate to "Settings->Lazy Load Videos & Sticky Control Settings" from your dashboard, and write the CSS rules in the code editor.

= Will the plugin support other videos? 
This free version only support YouTube videos. You can contact me and buy a Premium addon plugin. The addon provides supports for HTML5, Vimeo, JWplayer, Wistia video and many more in the near future.

= Do this plugin add more features in the future?
Yes, more features will be added and updated in the near future.

= Plugin not working?
Please install the latest version of this plugin. Clear the cache if you have installed any cache plugin or set up any third-party tools like Cloudflare.


== Screenshots ==
1. Frontend: Lazy load video preview and sticky playing video on the bottom right 
2. Backend: General settings
3. Backend: Manual/Guide
4. Backend: **LLVASC** icon on classical editor that help to embed shortcode on the content
5. Backend: **LLVASC** block for block editor
6. Backend: **LLVASC** block settings inspect control

== Changelog ==
= 3.0.0 (2024-06-24) =
* Added: LLVASC block on block editor (Gutenberg). 
* Tested compatibility with WordPress version 6.5.4

= 2.0.2 (2023-04-18) =
* Changed: Play icon missing fixes. 
* And other minor changes and tested to WordPress version 6.2

= 2.0.1 (2020-12-14) =
* Changed: Minor update on JavaScript due to some changes by Youtube player

= 2.0.0 (2020-04-12) =
* Changed: Minor update on JavaScript due to some changes by Youtube player

= 1.0.2 (2020-01-20) =
* Changed: Minor update
* Changed: Javascript Modularization

= 1.0.1 =
* Changed: Added "LLVASC" icon on the backend editor to add a shortcode to the content
* Changed: Javascript updated
