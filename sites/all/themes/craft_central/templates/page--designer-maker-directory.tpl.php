<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to main-menu administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

<div class="jspace-70"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-left">
                <nav role="navigation">
                  <div id="menuToggle">
                    <input class="switcher" type="checkbox"/>
                    <span></span>
                    <span></span>
                    <span></span>
                    <?php 
                      if (module_exists('i18n')) {
                        $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
                      } else {
                        $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
                      }
                      print drupal_render($main_menu_tree);
                    ?>
                    </div>
                    <div class="clear"></div>
                </nav>
            </div>
            <div class="pull-left ml-33">
              <div class="pull-left">
                <a href="<?php print url('user/'); ?>">
                  <img src="<?php print base_path() . drupal_get_path('theme', 'craft_central') . '/images/user_profile.png'; ?>" />
                </a>
              </div>
              <div class="pull-left ml-20">
                <?php
                $searchBlock = module_invoke('search', 'block_view', 'search');
                print render($searchBlock);
                ?>
              </div>
              <div class="clearfix"></div>
              <div class="jspace-20"></div>
              <div class="">
                <?php if(theme_get_setting('breadcrumbs', 'craft_central')): ?>
                <div id="breadcrumbs">
                  <?php if ($breadcrumb): print $breadcrumb; endif;?>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="pull-right">
              <a href="<?php print $front_page; ?>" title="<?php print t('Craft Central'); ?>">
                <img src="<?php print $logo; ?>" class="img-responsive" style="max-width:175px"/>
              </a>
            </div>
        </div>
    </div>
</div>
<div class="jspace-30"></div>
<div class="bg-pink">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="page_title"><?php print ucwords($title); ?></h1>
      </div>
    </div>
  </div>
</div>
<div class="bg-lightgray">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <?php if ($page['content_header_one']): ?>
        <div class="row">
          <div class="col-sm-12" id="content-header-one">
          <?php print render($page['content_header_one']); ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if ($page['content_header_two']): ?>
        <div class="row">
          <div class="col-sm-12" id="content-header-two">
          <?php print render($page['content_header_two']); ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if ($page['content_header_three']): ?>
        <div class="row">
          <div class="col-sm-12" id="content-header-three">
          <?php print render($page['content_header_three']); ?>
          </div>
        </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-sm-12">
            <section role="main">
            <?php print $messages; ?>
<?php if($is_front){ $title = '<img src="' . path_to_theme() . '/images/hightlights.png" />'; } ?>
<?php if(current_path() == 'vogue'){ $title = '<img src="' . path_to_theme() . '/images/vogue.png" />'; } ?>
<?php print render($title_suffix);//view config link ?>
<?php print render($page['help']); ?>
<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
<?php if($is_front){ unset($page['content']['system_main']['default_message']); } ?>
<?php print render($page['content']); ?>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-white p30-0">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-muted font-playfair">
        <span class="">Craft Central, 33-35 St John's Square, London, EC1M 4DS</span>
        <span class="ml-30">+44 (0)20 7251 0276</span>
      </div>
    </div>
  </div>
</div>
<div class="bg-darkgray p30-0">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-white-ash font-playfair">
        <span class="">Craft Central is the new working name for Clerkenwell Green Association. Registered charity number 281415. &copy; 2007-<?php echo date('Y', time()); ?> Clerkenwell Green Association</span>
      </div>
    </div>
  </div>
</div>
