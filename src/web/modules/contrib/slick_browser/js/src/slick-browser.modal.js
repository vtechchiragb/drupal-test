/**
 * @file
 * Provides Slick Browser utilitiy functions.
 */

(function ($, Drupal, _d, _win) {

  'use strict';

  var _isLoading = 'is-b-loading';
  var _addClass = 'addClass';
  var _removeClass = 'removeClass';
  var _cHtmlDialog = 'sb-html-dialog';
  var _eDialogOpen = 'dialogopen';
  var _eDialogClose = 'dialogclose';
  var _selUiDialog = '.ui-dialog';

  /**
   * Adds relevant context when slick browser is active.
   *
   * @param {jQuery.Event} e
   *   The event triggered.
   *
   * @todo: Remove this when SB can stay at parent window.
   */
  function sbModal(e) {
    var $content = $(e.target);
    var id = $content.attr('id');
    var $iframe = $content.find('iframe[name*="slick_browser"]');

    if (id.indexOf('slick-browser') !== -1) {
      $('html')[e.type === _eDialogOpen ? _addClass : _removeClass](_cHtmlDialog);
      $(_selUiDialog)[e.type === _eDialogOpen ? _addClass : _removeClass]('ui-dialog--sb');

      // Remove padding for spacious window with tabs, navs and video previews.
      $content.addClass(_isLoading).css('padding', 0);

      _win.setTimeout(function () {
        if ($iframe.length) {
          $iframe.on('load', function () {
            $content.removeClass(_isLoading);
          });
        }
      }, 600);
    }

    // Anything else, after AJAX-related events such as Edit/ Remove buttons.
    if (e.type === _eDialogClose) {
      $('.' + _isLoading).removeClass(_isLoading);
    }
  }

  /**
   * Attaches Slick Browser modal behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserModal = {
    attach: function (context) {
      $(document)
        .on(_eDialogOpen, _selUiDialog, sbModal)
        .on(_eDialogClose, _selUiDialog, sbModal);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        $('html').removeClass(_cHtmlDialog);
      }
    }
  };

})(jQuery, Drupal, dBlazy, this);
