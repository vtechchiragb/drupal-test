<?php

namespace Drupal\page_specific_class\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure custom settings for Page Specific Class.
 */
class PageSpecificClassSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'page_specific_class_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['page_specific_class.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('page_specific_class.settings');

    $description = $this->t('Mention path of pages where you want to add class in body tag.');
    $description .= '<ul>';
    $description .= '<li>' . $this->t('An example <b>path is /hello-world</b> and you want to <b>add class "xyz"</b> on body tag of this page then enter  <b>/hello-world|xyz</b> in text-area') . '</li>';
    $description .= '<li>' . $this->t('An example <b>path is /page-example</b> and you want to <b>add multiple classes like "xyz1 xyz2 xyz3"</b> on body tag of this page then enter  <b>/hello-world|xyz1 xyz2 xyz3</b> in text-area') . '</li>';
    $description .= '<li>' . $this->t('An example for wildcard urls: <b>/content/article*</b> and you want to add class <b>"dummy-articles"</b> on body tag of those pages then enter  <b>/content/article*|dummy-articles</b> in text-area') . '</li>';
    $description .= '' . $this->t('For exmaple we have <b>two article nodes</b> as <b>/content/article/1</b> and <b>/content/article/2</b> and we want to add <b>dummy-articles</b> class on both articles then simply add <b>/content/article*|dummy-articles</b> in text-area') . '';
    $description .= '<li>' . $this->t('If you want to <b>add class "home-page"</b> in <b>home page</b> body tag then enter  <b>/&lt;front&gt;|home-page</b>') . '</li>';
    $description .= '<li>' . $this->t('To add class <b>"all-page"</b> in <b>each page</b> body tag then enter <b>/*|all-page</b>') . '</li>';
    $description .= '<li>' . $this->t('Enter <b>one path</b> along with class <b>per line</b>') . '</li>';
    $description .= '<li>' . $this->t('Path should <b>start with "/"</b> as well as path and class should <b>seperated with "|".</b>') . '</li>';
    $description .= '</ul><br>';

    $description .= '<ul>';
    $description .= '<li>' . $this->t("Exmaple for url's along with classes '|' seperated are as follows.") . '</li>';
    $description .= '<b>' . $this->t('/hello-world|xyz') . '<br>';
    $description .= '' . $this->t('/hello-world|xyz1 xyz2 xyz3') . '<br>';
    $description .= '' . $this->t('/content/article*|dummy-articles') . '<br>';
    $description .= '' . $this->t('/&lt;front&gt;|home-page') . '<br>';
    $description .= '' . $this->t('/*|all-page') . '';
    $description .= '</ul></b>';

    $form['url_with_class'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Enter url along with class "|" seperated and path should start with "/"'),
      '#description' => $description,
      '#rows' => 10,
      '#default_value' => $config->get('url_with_class'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $url_with_class = $form_state->getValue('url_with_class');
    if (!empty($url_with_class)) {
      $enteredArr = explode(PHP_EOL, $url_with_class);
      foreach ($enteredArr as $values) {
        $urlWithClassArr = explode("|", $values);
        $url = $urlWithClassArr[0];
        if ($url[0] !== '/') {
          $form_state->setErrorByName('url_with_class', $this->t("@url path needs to start with a slash.", ['@url' => $url]));
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $urlWithClass = $form_state->getValue('url_with_class');
    $config = $this->config('page_specific_class.settings');
    $config->set('url_with_class', $urlWithClass);
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
