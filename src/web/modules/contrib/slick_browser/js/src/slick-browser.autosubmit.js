/**
 * @file
 * Provides Slick Browser view exposed form utilitiy functions.
 */

(function ($, Drupal, _d) {

  'use strict';

  var _nick = 'sb';
  var _autosubmit = 'autosubmit';
  var _autoselect = 'autoselect';
  var _idSubmit = _nick + '__' + _autosubmit;
  var _idSelect = _nick + '--' + _autoselect;
  var _idOnceSubmit = _nick + '-' + _autosubmit;
  var _idOnceSelect = _nick + '-' + _autoselect;
  var _onSubmit = _idSubmit + '--on';
  var _onSelect = _idSelect + '--on';
  var _selSubmit = '.' + _idSubmit + ':not(.' + _onSubmit + ')';
  var _selSelect = '.' + _idSelect + ':not(.' + _onSelect + ')';
  var _cViewSbFilter = 'view--sb-filter-';
  var _isFilterChecked = 'is-filter-checked';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Slick Browser utility functions.
   *
   * @param {HTMLElement} el
   *   The form-radio HTML element.
   */
  function fnAutoSubmit(el) {
    var $el = $(el);
    var $view = $el.closest('.view--sb');
    var val = $el.find('.form-radio:checked').val().replace('_', '-');

    $view.addClass(_cViewSbFilter + val);
    if ($view.find('.view-empty').length) {
      $view.addClass(_cViewSbFilter + 'empty');
    }

    $el.find('.form-radio').each(function () {
      var $radio = $(this);
      val = $radio.val().replace('_', '-');

      $radio.on('change', function () {
        $view.removeClass(_cViewSbFilter + val);
        $view.addClass(_cViewSbFilter + val);

        $('.' + _isFilterChecked, $el).removeClass(_isFilterChecked);
        $radio.parent().addClass(_isFilterChecked);

        $el.find('.form-submit').trigger('click');
      });
    });

    $el.addClass(_onSubmit);
  }

  /**
   * Autu select bundle if it is a Media browser to save another click.
   *
   * @param {HTMLElement} widget
   *   The .sb--autoselect HTML element.
   */
  function fnAutoSelect(widget) {
    var $widget = $(widget);
    var $iframe = $('iframe[name*="slick_browser"]', widget);
    var $doc;
    var entityTypeId = $widget.data('sbEntityTypeId');
    var bundle = $widget.data('sbBundle');
    var $autoSubmit;
    var $radio;

    var onloadAutoSelect = function () {
      $doc = $iframe.contents();
      $autoSubmit = $('.' + _idSubmit, $doc);
      $radio = $('.form-radio[value="' + bundle + '"]', $autoSubmit);

      // We are outside node form, at Media browser containing media bundle.
      if ($radio.length) {
        $radio.trigger('click');
      }
    };

    if (entityTypeId === 'media') {
      $iframe.on('load', onloadAutoSelect);
    }
    $widget.addClass(_onSelect);
  }

  /**
   * Attaches Slick Browser view exposed form behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserAutoSubmit = {
    attach: function (context) {
      _d.once(fnAutoSubmit, _idOnceSubmit, _selSubmit, context);
      _d.once(fnAutoSelect, _idOnceSelect, _selSelect, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        _d.once.removeSafely(_idOnceSubmit, _selSubmit, context);
        _d.once.removeSafely(_idOnceSelect, _selSelect, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy);
