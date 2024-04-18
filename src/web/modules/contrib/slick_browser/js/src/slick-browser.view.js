/**
 * @file
 * Provides Slick Browser view utilitiy functions.
 */

(function ($, Drupal, _d, _win) {

  'use strict';

  var _nick = 'sb';
  var _root = '.' + _nick;
  var _idView = _nick + '-view';
  var _cViewSb = 'view--sb';
  var _onView = _cViewSb + '--on';
  var _selView = '.' + _cViewSb + ':not(.' + _onView + ')';
  var _idGrid = _nick + '-grid';
  var _onGrid = _idGrid + '--on';
  var _baseGrid = '.grid';
  var _selGrid = _root + ' ' + _baseGrid + ':not(.' + _onGrid + ')';
  var _idMedia = _nick + '-media';
  var _onMedia = _idMedia + '--on';
  var _sMedia = _root + ' .media:not(.' + _onMedia + '):not(.media--switch)';
  var _selViewsFieldPreview = '.views-field--preview';
  var _selGridContent = '.grid__content';
  var _cInfoActive = 'is-sb-info-active';
  var _minHeight = 'minHeight';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Slick Browser utility functions.
   *
   * @param {HTMLElement} view
   *   The view HTML element.
   */
  function fnView(view) {
    var $view = $(view);
    var $slick = $('.slick__slider', view);

    // Fixed for vertical direction cropped slide.
    if ($slick.length && !$slick.hasClass('slick-initialized')) {
      $slick.on('init.sb', function () {
        _win.setTimeout(function () {
          $slick[0].slick.refresh();
        }, 500);
      });
    }

    /**
     * Build plain thumbnails for complex rendered entity for lits/table view.
     *
     * @param {HTMLElement} media
     *   The media HTML element.
     */
    function fnThumbnail(media) {
      var $media = $(media);
      var thumb = $media.data('thumb');

      if (thumb && !$('.media__thumbnail', media).length) {
        $media.append('<img src="' + thumb + '" alt="' + Drupal.t('Thumbnail') + '" class="media__thumbnail visible-list">');
        $media.addClass('media--list');
      }

      $media.addClass(_onMedia);
    }

    // Add a contextual class that Slick browser is active.
    $view.closest('html').addClass('sb-html');

    // Pass the grid info into .grid__content.
    // Replaces complex rendered entity with plain thumbnails for table view.
    _d.once(fnThumbnail, _idMedia, _sMedia, view);

    // After AJAX pager, add sb__main class to view parent element.
    if ($view.parent('div').length) {
      $view.closest('form').find('> div:not(.sb__header, .sb__footer)').addClass('sb__main');
    }

    $view.addClass(_onView);
  }

  /**
   * Build the grid info extracted from exisiting elements.
   *
   * @param {HTMLElement} grid
   *   The grid HTML element.
   */
  function fnGrid(grid) {
    var $grid = $(_selGridContent, grid);
    var previewHeight = 160;
    if (!$('.views-field', grid).length) {
      return;
    }

    _win.setTimeout(function () {
      if ($(_selViewsFieldPreview, grid).length) {
        previewHeight = $(grid).height();
        $(_selViewsFieldPreview, grid).css(_minHeight, previewHeight);
      }
    }, 100);

    /**
     * Toggle the grid info.
     *
     * @param {jQuery.Event} event
     *   The event triggered by a `click` event.
     */
    function toggleGridInfo(event) {
      event.preventDefault();
      event.stopPropagation();

      var $activeGrid = $(event.target).closest(_baseGrid);

      if ($(_selViewsFieldPreview, $activeGrid).length) {
        if ($('.media', $activeGrid).length) {
          $(_selGridContent, $activeGrid).css(_minHeight, previewHeight > 120 ? previewHeight + 12 : 160);
        }
      }

      $activeGrid.toggleClass(_cInfoActive);
      if (!$activeGrid.hasClass(_cInfoActive)) {
        $(_selGridContent, $activeGrid).css(_minHeight, '');
      }
    }

    // @todo fault proof.
    var $clone = $grid.find('.views-field:not(.views-field-entity-browser-select, .views-field--preview, .views-field--grid-hidden)').clone();

    $clone.each(function () {
      var $field = $(this);
      if ($field.find('.media, img, iframe').length) {
        $field.empty();
      }
    });

    // Remove the views-field class to avoid CSS override.
    // @todo $clone.removeClass('views-field').addClass('views-field--cloned');
    // Add a button to toggle the grid info.
    if (!$('.button-group--grid', grid).length) {
      $grid.append('<div class="button-group button-wrap button-group--grid is-button-js"><button class="button button--select" type="button">&#43;</button><button class="button button--info" type="button">?</button></div>');
    }
    // Append the new .grid__info element.
    // @todo if (!$('.grid__info', grid).length) {
    // @todo   $grid.append('<div class="grid__info visible-grid" />');
    // @todo }
    // @todo if (!$('.grid__info .views-field--cloned', grid).length) {
    // @todo $('.grid__info', grid).append($clone);
    // @todo }
    // Events.
    $grid.on('click.sbGridInfo', '.button--info', toggleGridInfo);
    $grid.addClass(_onGrid);
  }

  /**
   * Attaches Slick Browser view behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserView = {
    attach: function (context) {
      _d.once(fnView, _idView, _selView, context);
      _d.once(fnGrid, _idGrid, _selGrid, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        _d.once.removeSafely(_idView, _selView, context);
        _d.once.removeSafely(_idGrid, _selGrid, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy, this);
