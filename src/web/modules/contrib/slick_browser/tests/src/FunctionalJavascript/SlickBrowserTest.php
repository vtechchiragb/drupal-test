<?php

namespace Drupal\Tests\slick_browser\FunctionalJavascript;

use Drupal\Core\File\FileSystemInterface;
use Drupal\file\Entity\File;
use Drupal\FunctionalJavascriptTests\DrupalSelenium2Driver;
use Drupal\Tests\entity_browser\FunctionalJavascript\EntityBrowserWebDriverTestBase;

/**
 * Tests the Slick Browser JavaScript using Selenium, or Chromedriver.
 *
 * @requires module dropzonejs_eb_widget
 *
 * @group slick_browser
 */
class SlickBrowserTest extends EntityBrowserWebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'claro';

  /**
   * {@inheritdoc}
   */
  protected $minkDefaultDriverClass = DrupalSelenium2Driver::class;

  /**
   * The app root.
   *
   * @var string
   */
  protected $root;

  /**
   * The file system service.
   *
   * @var \Drupal\Core\File\FileSystem
   */
  protected $fileSystem;

  /**
   * Test directory path.
   *
   * @var string
   */
  protected $testDirPath;

  /**
   * The tested file.
   *
   * @var \Drupal\file\FileInterface
   */
  protected $testFile;

  /**
   * The tested formatter ID.
   *
   * @var string
   */
  protected $testPluginId;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'filter',
    'field',
    'user',
    'file',
    'image',
    'media',
    'block_content',
    'inline_entity_form',
    'entity_browser',
    'entity_browser_entity_form',
    'entity_browser_test',
    'dropzonejs',
    'dropzonejs_eb_widget',
    'blazy',
    'blazy_test',
    'slick',
    'slick_browser',
    'slick_browser_test',
  ];

  /**
   * {@inheritdoc}
   */
  protected static $userPermissions = [
    // @todo refine based on actual browsers to test against.
    'access slick_browser_file entity browser pages',
    'create article content',
    'access content',
    'access content overview',
    'create media',
    'access media overview',
    'access files overview',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->root = $this->root($this->container);
    $this->fileSystem = $this->container->get('file_system');
    $this->testPluginId = 'slick_browser';

    /** @var \Drupal\Core\Entity\Display\EntityFormDisplayInterface $form_display */
    $form_display = $this->container->get('entity_type.manager')
      ->getStorage('entity_form_display')
      ->load('node.article.default');

    $settings = [
      'style' => 'grid',
      'image_style' => 'slick_browser_preview',
      'grid' => 3,
      'grid_medium' => 2,
      'grid_small' => 1,
    ];
    $form_display->setComponent('field_reference', [
      'type' => 'entity_browser_entity_reference',
      'settings' => [
        'entity_browser' => 'slick_browser_file',
        'field_widget_display' => 'slick_browser_file',
        'field_widget_remove' => TRUE,
        'field_widget_replace' => TRUE,
        'open' => TRUE,
        'selection_mode' => 'selection_append',
        // This is expected by file, media, node entities.
        'field_widget_display_settings' => $settings,
      ],
      // This is expected by image, or core media library.
      'third_party_settings' => [
        'slick_browser' => $settings,
      ],
    ])->save();

    $account = $this->drupalCreateUser(static::$userPermissions);
    $this->drupalLogin($account);

    $this->testFile = $this->createDummyImage();
  }

  /**
   * Tests that selecting files in the view works even with direct selection.
   */
  public function testSlickBrowserFileDirectSelection() {
    $this->drupalGet('node/add/article');

    // Ensures Slick Widget exists.
    $this->assertSession()->elementExists('css', '.sb--widget');

    // Open the browser and select a file.
    // @todo $this->drupalGet('entity-browser/iframe/slick_browser_file');
    $this->getSession()->switchToIFrame('entity_browser_iframe_slick_browser_file');

    $this->waitForAjaxToFinish();

    // Wait another moment, iframe build is slow.
    $this->assertSession()->elementNotExists('css', '.is-sb-checked');

    // Wait a moment.
    /* @phpstan-ignore-next-line */
    $result = $this->assertSession()->waitForElement('css', '.grid');
    $this->assertNotEmpty($result);
    $this->assertCheckboxExistsByValue('file:' . $this->testFile->id());

    $this->getSession()->getPage()->find('css', '.grid')->press();

    $this->assertSession()->elementExists('css', '.is-sb-checked');

    // Ensures AJAX is triggered to insert the image into the page.
    $this->getSession()->getPage()->pressButton('Add to Page');

    // Switch back to the main page.
    $this->getSession()->switchToIFrame();
    $this->waitForAjaxToFinish();

    // Ensures image is inserted into the page.
    // @todo update asserts, irrelevant for one image, no sortable.
    // $result = $this->assertSession()->waitForElement('css', '.sb__sortitem');
    // $this->assertNotEmpty($result);
    // $this->assertSession()->elementExists('css', '.sb__sortitem');
    /* @phpstan-ignore-next-line */
    $result = $this->assertSession()->waitForElement('css', '.sb--widget');
    $this->assertNotEmpty($result);
    $this->assertSession()->elementExists('css', '.views-field--preview');

    // Tests the Delete functionality.
    // Cases:
    // - Cardinality 1, relies on AJAX to rebuild link post removal.
    // - Cardinality > 1 or -1, has always Media library link, quick removal.
    $this->assertSession()->buttonExists('Remove');

    $this->getSession()->getPage()->find('css', '.button--wrap__mask')->press();
    $this->getSession()->getPage()->find('css', '.button--wrap__confirm')->press();

    $this->waitForAjaxToFinish();

    // @todo update asserts, irrelevant for one image, no sortable.
    // $result = $this->assertSession()->waitForElement('css', '.sb__sortitem');
    // $this->assertEmpty($result);
    // $this->assertSession()->elementNotExists('css', '.sb__sortitem');
    $this->assertSession()->elementNotExists('css', '.views-field--preview');
  }

  /**
   * Tests that selecting files in the view works even with delay selection.
   */
  public function testSlickBrowserFileDelaySelection() {
    $this->drupalGet('node/add/article');

    // Ensures Slick Widget exists.
    $this->assertSession()->elementExists('css', '.sb--widget');

    // Open the browser and select a file.
    $this->getSession()->switchToIFrame('entity_browser_iframe_slick_browser_file');

    $this->waitForAjaxToFinish();

    // Wait another moment, iframe build is slow.
    $this->assertSession()->elementNotExists('css', '.is-sb-checked');

    /* @phpstan-ignore-next-line */
    $result = $this->assertSession()->waitForElement('css', '.grid');
    $this->assertNotEmpty($result);
    $this->assertCheckboxExistsByValue('file:' . $this->testFile->id());

    $this->getSession()->getPage()->find('css', '.grid')->press();

    $this->assertSession()->elementExists('css', '.is-sb-checked');

    // Delays selection.
    $this->getSession()->getPage()->pressButton('Select files');
    $this->waitForAjaxToFinish();

    // Ensures selected files were not gone.
    $this->assertSession()->elementExists('css', '.was-sb-checked');

    // Ensures AJAX is triggered to insert the image into the page.
    $this->getSession()->getPage()->pressButton('Add to Page');

    // Switch back to the main page.
    $this->getSession()->switchToIFrame();
    $this->waitForAjaxToFinish();

    // Ensures image is inserted into the page.
    // @todo update asserts, irrelevant for one image, no sortable.
    // $result = $this->assertSession()->waitForElement('css', '.sb__sortitem');
    // $this->assertNotEmpty($result);
    // $this->assertSession()->elementExists('css', '.sb__sortitem');
    /* @phpstan-ignore-next-line */
    $result = $this->assertSession()->waitForElement('css', '.sb--widget');
    $this->assertNotEmpty($result);

    $this->assertSession()->elementExists('css', '.views-field--preview');
    // @todo $this->assertSession()->elementContains('css', '.views-field--preview', 'img');
  }

  /**
   * Returns the created image file.
   */
  protected function createDummyImage($name = '', $source = '') {
    $name   = $name ?: $this->testPluginId . '.png';
    $source = $source ?: $this->root . '/core/misc/druplicon.png';
    $uri    = 'public://' . $name;

    $this->fileSystem->copy($source, $uri, FileSystemInterface::EXISTS_REPLACE);

    $item = File::create([
      'uri' => $uri,
      'filename' => $name,
    ]);
    $item->setPermanent();
    $item->save();

    return $item;
  }

  /**
   * Returns the cross-compat D8 ~ D10 app root.
   */
  protected function root($container): string {
    return \version_compare(\Drupal::VERSION, '9.0', '<')
      ? $container->get('app.root') : $container->getParameter('app.root');
  }

}
