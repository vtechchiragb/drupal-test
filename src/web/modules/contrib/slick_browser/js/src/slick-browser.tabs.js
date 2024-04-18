/**
 * @file
 * Provides Slick Browser utilitiy functions.
 */

(function ($, Drupal, _d, _win) {

  'use strict';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  var _formTabs = 'form--tabs';
  var _idTabs = 'sb-tabs';
  var _onTabs = _formTabs + '--on';
  var _element = '.' + _formTabs + ':not(.' + _onTabs + ')';
  var _selEbTabs = '.eb-tabs';
  var _tabsTimer;

  /**
   * Slick Browser utility functions.
   *
   * @param {HTMLElement} form
   *   The Entity Browser form HTML element.
   */
  function fnTabs(form) {
    var me = Drupal.slickBrowser;
    var $form = $(form);
    var pos = $form.data('tabsPos');
    var $tabs = $(_selEbTabs, form);

    // It seems taking time to build JS tabs.
    if (pos) {
      if ($tabs.length) {
        $tabs.prependTo('#edit-' + pos);
      }
      else {
        _win.clearTimeout(_tabsTimer);
        _tabsTimer = _win.setTimeout(function () {
          $(_selEbTabs, form).prependTo('#edit-' + pos);
        }, 800);
      }
    }

    // Adds loading indicator whenever a tab is clicked.
    $form.on('click', '.eb-tabs a:not(.is-active)', me.loading);
    $form.on('click mousedown', '.sb__header input', me.loading);
    $form.addClass(_onTabs);
  }

  /**
   * Attaches Slick Browser tabs behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserTabs = {
    attach: function (context) {
      _d.once(fnTabs, _idTabs, _element, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        _d.once.removeSafely(_idTabs, _element, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy, this);
