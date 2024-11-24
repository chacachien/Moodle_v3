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
 * @package   theme_boost
 * @copyright 2016 Ryan Wyllie
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingboost', get_string('configtitle', 'theme_boost'));
    $page = new admin_settingpage('theme_boost_general', get_string('generalsettings', 'theme_boost'));

    // Unaddable blocks.
    // Blocks to be excluded when this theme is enabled in the "Add a block" list: Administration, Navigation, Courses and
    // Section links.
    $default = 'navigation,settings,course_list,section_links';
    $setting = new admin_setting_configtext('theme_boost/unaddableblocks',
        get_string('unaddableblocks', 'theme_boost'), get_string('unaddableblocks_desc', 'theme_boost'), $default, PARAM_TEXT);
    $page->add($setting);

    // Preset.
    $name = 'theme_boost/preset';
    $title = get_string('preset', 'theme_boost');
    $description = get_string('preset_desc', 'theme_boost');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_boost', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configthemepreset($name, $title, $description, $default, $choices, 'boost');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_boost/presetfiles';
    $title = get_string('presetfiles','theme_boost');
    $description = get_string('presetfiles_desc', 'theme_boost');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Background image setting.
    $name = 'theme_boost/backgroundimage';
    $title = get_string('backgroundimage', 'theme_boost');
    $description = get_string('backgroundimage_desc', 'theme_boost');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Login Background image setting.
    $name = 'theme_boost/loginbackgroundimage';
    $title = get_string('loginbackgroundimage', 'theme_boost');
    $description = get_string('loginbackgroundimage_desc', 'theme_boost');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_boost/brandcolor';
    $title = get_string('brandcolor', 'theme_boost');
    $description = get_string('brandcolor_desc', 'theme_boost');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    //
  /*
  * -----------------------
  * Frontpage settings tab
  * -----------------------
  */
  $page = new admin_settingpage('theme_boost_frontpage', get_string('frontpagesettings', 'theme_boost'));


  // Slideshow.
  $name = 'theme_boost/slidercount';
  $title = get_string('slidercount', 'theme_boost');
  $description = get_string('slidercountdesc', 'theme_boost');
  $default = 0;
  $options = array();
  for ($i = 0; $i < 13; $i++) {
    $options[$i] = $i;
  }
  $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
  $setting->set_updatedcallback('theme_reset_all_caches');
  $page->add($setting);

  // If we don't have an slide yet, default to the preset.
  $slidercount = get_config('theme_boost', 'slidercount');

//  if (!$slidercount) {
//    $slidercount = $default;
//  }

  if ($slidercount) {
    for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
      $fileid = 'sliderimage' . $sliderindex;
      $name = 'theme_boost/sliderimage' . $sliderindex;
      $title = get_string('sliderimage', 'theme_boost');
      $description = get_string('sliderimagedesc', 'theme_boost');
      $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
      $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
      $page->add($setting);

      $name = 'theme_boost/slidertitle' . $sliderindex;
      $title = get_string('slidertitle', 'theme_boost');
      $description = get_string('slidertitledesc', 'theme_boost');
      $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
      $page->add($setting);

      $name = 'theme_boost/slidercap' . $sliderindex;
      $title = get_string('slidercaption', 'theme_boost');
      $description = get_string('slidercaptiondesc', 'theme_boost');
      $default = '';
      $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
      $page->add($setting);
    }
  }

  $setting = new admin_setting_heading('slidercountseparator', '', '<hr>');
  $page->add($setting);


  // Enable FAQ.
  $name = 'theme_boost/faqcount';
  $title = get_string('faqcount', 'theme_boost');
  $description = get_string('faqcountdesc', 'theme_boost');
  $default = 0;
  $options = array();
  for ($i = 0; $i < 11; $i++) {
    $options[$i] = $i;
  }
  $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
  $page->add($setting);

  $faqcount = get_config('theme_boost', 'faqcount');

  if ($faqcount > 0) {
    for ($i = 1; $i <= $faqcount; $i++) {
      $name = "theme_boost/faqquestion{$i}";
      $title = get_string('faqquestion', 'theme_boost', $i . '');
      $setting = new admin_setting_configtext($name, $title, '', '');
      $page->add($setting);

      $name = "theme_boost/faqanswer{$i}";
      $title = get_string('faqanswer', 'theme_boost', $i . '');
      $setting = new admin_setting_confightmleditor($name, $title, '', '');
      $page->add($setting);
    }

    $setting = new admin_setting_heading('faqseparator', '', '<hr>');
    $page->add($setting);
  }

  $settings->add($page);




  //
    // Advanced settings.
    $page = new admin_settingpage('theme_boost_advanced', get_string('advancedsettings', 'theme_boost'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_boost/scsspre',
        get_string('rawscsspre', 'theme_boost'), get_string('rawscsspre_desc', 'theme_boost'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_boost/scss', get_string('rawscss', 'theme_boost'),
        get_string('rawscss_desc', 'theme_boost'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
