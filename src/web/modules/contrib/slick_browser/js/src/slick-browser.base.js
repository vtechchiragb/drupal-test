/**
 * @file
 * Provides Slick Browser utilitiy functions.
 */

(function ($, Drupal, _d, _win) {

  'use strict';

  var _onSb = 'sb--on';
  var _onItem = 'sb-item-container--on';
  var _onDetails = 'sb--wrapper-hidden--on';
  var _onMediaRendered = 'media--rendered--on';
  var _isLoading = 'is-b-loading';
  var _isActive = 'is-active';
  var _isOpen = 'is-open';
  var _isAjax = 'is-sb-ajax';
  var _selIsOpen = '.' + _isOpen;
  var _visuallyHidden = 'visually-hidden';
  var _cSafe = 'sb--safe';
  var _selItemContainer = '.item-container';
  var _isDeleted = 'is-deleted';
  var _selFile = '.js-form-managed-file';
  var _mouseTimer;

  /**
   * Slick Browser utility functions.
   *
   * @namespace
   */
  Drupal.slickBrowser = {

    /**
     * Provides common Slick Browser utilities.
     *
     * @name sb
     *
     * @param {HTMLElement} elm
     *   Any slick browser HTML element.
     */
    sb: function (elm) {
      var $elm = $(elm);
      var $slick = $('.slick__slider', elm);
      var cardinality = parseInt($elm.data('sbCardinality'), 0);

      $('.slick__arrow button', elm).addClass('button');
      $('.slick__arrow', elm).addClass('button-group button-group--icon');

      $elm.on('click', '.button--wrap__mask', function () {
        $(this).parent().addClass(_isOpen);
        return false;
      });

      $('.button--remove', elm).on('click mousedown', function () {
        $(this).closest('.grid, .slide, .item-container').addClass(_isDeleted);
      });

      // , .button-wrap--confirm input
      // $('.button--wrap__confirm', elm).on('mouseleave touchend', function () {
      $elm.on('click', function () {
        // Fix for tests not recognizing hover.
        _win.clearTimeout(_mouseTimer);
        _mouseTimer = _win.setTimeout(function () {
          $(_selIsOpen, elm).removeClass(_isOpen);
        }, 1000);
      });

      var updateCount = function () {
        if ($elm.hasClass('sb--launcher')) {
          var count = $elm.find('input[data-entity-id]').length;
          $elm.attr('data-sb-count', count);

          if (cardinality > 0 && cardinality <= count) {
            $elm.addClass(_isAjax);
          }
        }
      };

      updateCount();

      // @todo support slick for quick deletion.
      $('.button--wrap__confirm', elm).on('click', function () {
        var $btn = $(this);
        var eid = $btn.next('input').data('entityId');
        var $static = $btn.closest('.sb--wrapper');

        if (eid && $static.length && !$elm.hasClass(_isAjax)) {
          var $storage = $static.find('> .details-wrapper > input:first');
          if ($storage.length) {
            var value = $storage.val();
            value = value.replace(eid, '').trim();
            $storage.val(value);

            if ($slick.length) {
              var index = $btn.closest('.slide').data('slickIndex');
              $slick.slick('slickRemove', index);
              $static.find('.sb__sortitem[data-row-id="' + index + '"]').remove();
            }

            $btn.closest('.grid, .slide').remove();
          }
        }

        updateCount();
      });

      $elm.addClass(_onSb);
    },

    /**
     * Fixes for hidden slick within details as otherwise broken.
     *
     * @name sbDetails
     *
     * @param {HTMLElement} elm
     *   Any details HTML element.
     */
    sbDetails: function (elm) {
      var $elm = $(elm);
      if ($elm.hasClass(_cSafe)) {
        return;
      }

      if ($('.sb__display', elm).length) {
        $elm.find('.details-wrapper').addClass(_visuallyHidden);
      }

      $('summary', elm).on('click', function () {
        if ($elm.attr('open')) {
          $elm.find('.details-wrapper').removeClass(_visuallyHidden);
          $elm.addClass(_cSafe);
          return false;
        }
      });

      $elm.addClass(_onDetails);
    },

    /**
     * Fixes for empty preview with rich media.
     *
     * @name sbMediaRendered
     *
     * @param {HTMLElement} elm
     *   Any .media--rendered HTML element.
     */
    sbMediaRendered: function (elm) {
      var $elm = $(elm);
      var url = $elm.data('thumb');
      if (url && !$elm.hasClass('b-bg')) {
        $elm.css('backgroundImage', 'url(' + url + ')');
      }

      $elm.addClass(_onMediaRendered);
    },

    /**
     * Reacts on item container button actions.
     *
     * @name itemContainer
     *
     * @param {HTMLElement} elm
     *   The item container HTML element.
     */
    itemContainer: function (elm) {
      var $elm = $(elm);
      $('.button', elm).on('mousedown.sbAction', function () {
        $(this).closest(_selItemContainer).addClass(_isLoading);
      });

      $elm.addClass(_onItem);
    },

    /**
     * Jump to the top.
     *
     * @name jump
     *
     * @param {HTMLElement} id
     *   The slick widget HTML element ID.
     */
    jump: function (id) {

      /* @todo
      if ($('#' + id).length) {
        $('html, body').stop().animate({
          scrollTop: $('#' + id).offset().top - 140
        }, 800);
      }
      */
    },

    /**
     * Add loading indicator in replacement for the stone-aged thobber.
     *
     * @param {jQuery.Event} e
     *   The event triggered by an AJAX `mousedown` event.
     */
    loading: function (e) {
      if (!$(e.currentTarget).hasClass(_isActive)) {
        $(e.currentTarget).closest(_selFile + ', .form--sb').addClass(_isLoading);
      }
    },

    /**
     * Removed loading indicator.
     *
     * @param {bool} all
     *   If true, remove all loading classes.
     */
    loaded: function (all) {
      $(_selFile).removeClass(_isLoading);
      if (all) {
        $('.' + _isLoading).removeClass(_isLoading);
      }
    }
  };

})(jQuery, Drupal, dBlazy, this);
