/**
 * @file
 * Provides Slick Browser view utilitiy functions.
 */

(function ($, Drupal, _d) {

  'use strict';

  var _nick = 'sb';
  var _viewswitch = 'viewswitch';
  var _id = _nick + '__' + _viewswitch;
  var _idSwitch = _nick + '-' + _viewswitch;
  var _onSwitch = _id + '--on';
  var _selSwitch = '.' + _id + ':not(.' + _onSwitch + ')';
  var _isActive = 'is-sb-active';
  var _isInfoActive = 'is-sb-info-active';
  var _isCollapsed = 'is-sb-collapsed';
  var _selVLHeader = '.view-list--header';
  var _selBtn = '.button';
  var _cHelp = 'view--sb-help';
  var _selIdSwitch = '#sb-' + _viewswitch;
  var _selPager = '.pager__items';
  var _baseGrid = '.grid';
  var _blazy = Drupal.blazy || null;

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Slick Browser utility functions.
   *
   * @param {HTMLElement} switcher
   *   The switcher HTML element.
   */
  function fnViewSwitch(switcher) {
    var $switcher = $(switcher);
    var $form = $switcher.closest('.form--sb');
    var $container = $form.length ? $form : $switcher.closest('.view');
    var $head = $('.sb__header');
    // @todo var $slick = $container.find('.slick:first');
    // @todo var slicked = $slick.length && $('.slick__slider', $slick).hasClass('slick-initialized');
    var $firstGrid = $container.find('.blazy--grid:first');
    var classes = $firstGrid.attr('class');

    /**
     * Build the fake table header like.
     */
    function buildTableHeader() {
      var $content = $('.view-content', $container);

      // Faking table header for the list view.
      if ($container.find(_baseGrid).length && !$(_selVLHeader, $container).length) {
        var $grid = $firstGrid.find(_baseGrid + ':first .grid__content');
        var $cloned = $grid.clone();

        $cloned.detach().insertBefore($content);

        // @todo recheck dups.
        if (!$cloned.closest(_selVLHeader).length) {
          $cloned.wrapAll('<div class="view-list view-list--header grid" />');
        }

        // Extracts the views-label to be the fake table header.
        $cloned.find('.views-field').each(function () {
          var $item = $(this);
          var txt = $item.find('.views-label').text();

          $item.empty().text(txt);
        });

        $cloned.find('.grid__info, .button-group').remove();
      }
    }

    /**
     * Switch the view display.
     *
     * @param {jQuery.Event} event
     *   The event triggered by a `click` event.
     */
    function switchView(event) {
      event.preventDefault();

      var $btn = $(event.currentTarget);
      var target = $btn.data('target');
      var $view = $('.view--sb');

      $btn.closest('.button-group').find(_selBtn).removeClass(_isActive);
      $btn.addClass(_isActive);

      if (target && $view.length) {
        $('.' + _isInfoActive).removeClass(_isInfoActive);

        if (target === 'help') {
          $container.removeClass(_isCollapsed);
          $container.toggleClass(_cHelp);
          $btn.text($container.hasClass(_cHelp) ? 'x' : '?');
        }
        else {
          $('.button--help', $container).text('?');
          $container.removeClass(_cHelp);
          $view.removeClass('view--sb-grid view--sb-list view--sb-help');
          $view.find('.blazy--grid').attr('class', target === 'list' ? 'sb__grid' : $switcher.data('classes'));
          $view.addClass('view--sb-' + target);

          // Revalidate potential slick clones.
          if (_blazy && _blazy.init !== null) {
            _blazy.init.revalidate(true);
          }

          // Manually refresh positioning of slick as the layout changes.
          // @todoif (slicked) {
          // @todo  $('.slick__slider', $container)[0].slick.refresh();
          // @todo}
        }
      }
    }

    /**
     * Trigger AJAX when reacing the end.
     *
     * @param {HTMLElement} elm
     *   The form or view container HTML element.
     */
    function triggerAjax(elm) {
      $('.slick__arrow', elm).addClass('button-group button-group--icon');
      $('.slick__slider', elm).on('beforeChange', function (event, slick, currentSlide) {
        var totalSlide = slick.$slides.length;
        var curr = currentSlide + 1;
        var $next = $(_selPager + ' a[rel="next"]', elm);
        var $prev = $(_selPager + ' a[rel="prev"]', elm);

        // Claro, doh.
        var $nextClaro = $(_selPager + ' .pager__item--next a', elm);
        var $prevClaro = $(_selPager + ' .pager__item--previous a', elm);

        if (curr === totalSlide) {
          if ($next.length) {
            $next.click();
          }
          else if ($prev.length) {
            $prev.click();
          }
          if ($nextClaro.length) {
            $nextClaro.click();
          }
          else if ($prevClaro.length) {
            $prevClaro.click();
          }
        }
      });
    }

    // Store original classes for the switcher.
    $switcher.data('classes', classes);

    // Build the fake table header.
    buildTableHeader();

    // If the switcher is embedded inside EB, append it to the form header.
    if ($head.length) {
      $head.find('.' + _id).remove();

      $switcher.addClass(_id + '--header').appendTo($head);
    }

    // The switcher can live within, or outside view, when EB kicks in.
    $(_selBtn, switcher).on('click.sbSwitch', switchView);

    // Makes the active button active.
    $(_selIdSwitch, $container).find('.button--view.' + _isActive).click();
    triggerAjax($container);
    $switcher.addClass(_onSwitch);
  }

  /**
   * Attaches Slick Browser view behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserViewSwitch = {
    attach: function (context) {
      _d.once(fnViewSwitch, _idSwitch, _selSwitch, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        _d.once.removeSafely(_idSwitch, _selSwitch, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy);
