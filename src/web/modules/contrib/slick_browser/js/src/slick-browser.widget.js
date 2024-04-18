/**
 * @file
 * Provides Slick Browser widget utility functions.
 */

(function ($, Drupal, Sortable, _d) {

  'use strict';

  var _nick = 'sb';
  var _isNick = 'is-' + _nick;
  var _root = '.' + _nick;
  var _idWidget = _nick + '-widget';
  var _onWidget = _nick + '--widget--on';
  var _baseWidget = _root + '--widget';
  var _selWidget = _root + '--widget:not(.' + _onWidget + ')';
  var _idSortable = _nick + '-sortable';
  var _onSortable = _nick + '__sortable--on';
  var _selSortable = _root + '__sortable:not(.' + _onSortable + ')';
  var _dataSlickIndex = 'data-slick-index';
  var _slickInitialized = 'slick-initialized';
  var _selCloned = '.slick-cloned';
  var _isActive = _isNick + '-active';
  var _isFocused = _isNick + '-focused';
  var _selSubmit = '.js-form-managed-file .js-form-submit:not(.button--sb)';
  var _cAjax = 'sbAjax';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Slick Browser widget utility functions.
   *
   * @param {HTMLElement} widget
   *   The Slick Browser widget HTML element.
   */
  function fbWidget(widget) {
    var $widget = $(widget);
    var $form = $widget.closest('form');
    var widgetId = $widget.attr('id');
    var $slider = $('.slick__slider', widget);
    var $sliderMain = $('.slick--browser .slick__slider', widget);
    var $sbAction = $('.sb__header', widget);
    var $dots = $('.slick-dots', widget);
    var $grids = $('.blazy--grid', widget);
    var $blazy = $('.blazy', widget);
    var end = $widget.data('end') ? $widget.data('end') : 0;
    var initialized = $sliderMain.hasClass(_slickInitialized);

    // We are allowed by Display style to use configurable Blazy Grid instead.
    // We use JS since this class is added by theme level later, not module.
    $('.media-library-item--grid', widget).removeClass('media-library-item--grid');

    /**
     * Clean up cloned ids.
     *
     * @name cleanUp
     */
    function cleanUp() {
      if (initialized) {
        $slider.find(_selCloned).removeAttr('data-entity-id data-row-id data-drupal-selector');

        $slider.on('setPosition', function () {
          $slider.find(_selCloned).removeAttr('data-entity-id data-row-id data-drupal-selector');
        });
      }
    }

    /**
     * Update widget height if dots too high.
     *
     * @name updateWidgetHeight
     */
    function updateWidgetHeight() {
      if ($dots.length) {
        var dh = $dots.height();
        var wh = $widget.height() - 80;
        if (wh <= dh) {
          $widget.css('minHeight', dh + 80);
        }
      }
      if ($grids.length) {
        if ($blazy.length) {
          Drupal.attachBehaviors($blazy[0]);
        }

        if ($sliderMain.length) {
          $sliderMain[0].slick.refresh();
        }
      }
    }

    /**
     * Update the view of the working widget.
     *
     * @name onUpdateView
     *
     * @param {jQuery.Event} event
     *   The event triggered, most likely a `click` event.
     */
    function onUpdateView(event) {
      event.preventDefault();

      var $btn = $(event.currentTarget);
      var handled = $btn.data('handled');
      var target = $btn.data('target');
      var $targetId = $widget.siblings('input[type*=hidden][name*="[target_id]"]');

      if (target !== 'done') {
        $widget.data('deltas', '');
      }

      $widget.toggleClass('is-sb-' + target);
      $.each(['caption', 'crop', 'sort', 'done'], function (i, btn) {
        if (target === 'done' || target !== btn) {
          $widget.removeClass('is-sb-' + btn);
        }
      });

      $('.button--sb').removeClass(_isActive);
      $('.button--' + target, widget)[$widget.hasClass('is-sb-' + target) ? 'addClass' : 'removeClass'](_isActive);

      var updateCount = function () {
        var count = $widget.find('input[data-entity-id]').length;
        $widget.attr('data-sb-count-items', count);
      };

      updateCount();

      switch (target) {
        case 'crop':
          if (!handled && $sliderMain.length) {
            $sliderMain[0].slick.refresh();
          }
          break;

        case 'remove':
          var entityId = $btn.data('entityId') || $btn.closest('[data-entity-id]').data('entityId');
          var ids = $targetId.val();
          var existing = $widget.data('removedId') || '';

          $targetId.val($.trim(ids.replace(entityId, '')));
          $widget.data('removedId', existing + ' ' + entityId);

          rebuildSlick($btn);

          $widget.find('.sb__sortable [data-entity-id="' + entityId + '"]').remove();

          updateCount();
          break;

        case 'removeall':
          $targetId.val('');
          $widget.contents(':not(div[id*="ajax-wrapper"])').remove();
          $widget.css('minHeight', 0);
          rebuildSlick($btn);

          updateCount();
          break;

        case 'done':
          if ($widget.data('deltas')) {
            rebuildSlick();
          }
          if ($sliderMain.length) {
            if ($('.slick-prev:not(.slick-disabled)', $sliderMain).length) {
              $('.slick-prev:not(.slick-disabled)', $sliderMain).trigger('click');
            }
            else if ($('.slick-next:not(.slick-disabled)', $sliderMain).length) {
              $('.slick-next:not(.slick-disabled)', $sliderMain).trigger('click');
            }
            else {
              $sliderMain[0].slick.refresh();
            }
          }

          updateCount();
          break;

        default:
          break;
      }

      $btn.data('handled', !handled);
      Drupal.slickBrowser.jump(widgetId);
      cleanUp();
      updateWidgetHeight();
    }

    /**
     * Rebuild the slick instances.
     *
     * @name rebuildSlick
     *
     * @param {jQuery.Object} $btn
     *   The triggering button HTML element.
     */
    function rebuildSlick($btn) {
      if (!$('.slick', widget).length) {
        return;
      }

      $('.slick', widget).each(function () {
        var $slider = $('.slick__slider', this);
        var $slide = $('.slide', $slider);
        var slick = $slider.slick('getSlick');
        var i = 0;
        var rebuild = false;

        if ($btn) {
          if ($btn.data('target') === 'removeall') {
            $slider.slick('removeSlide', null, null, true);
            // $widget.contents(':not(div[id*="ajax-wrapper"])').remove();
            rebuild = true;
          }
          else {
            var index = $btn.closest('.slide').data('slickIndex');

            // No need for $slider.slick('refresh');.
            $slider.slick('slickRemove', index);

            $slide.each(function () {
              $(this).attr(_dataSlickIndex, i);
              i++;
            });

            if ($slide.length === 1) {
              $widget.empty();
              rebuild = true;
            }
          }
        }
        else {
          $slide.sort(function (a, b) {
            return $(a).data('rowId') - $(b).data('rowId');
          });

          $slider.empty();
          $slide.clone().detach().appendTo($slider);

          $slider.slick(slick.options);
          rebuild = true;
        }

        if (rebuild) {
          Drupal.attachBehaviors($widget[0]);
          if ($('.media--player', $slide).length) {
            Drupal.attachBehaviors($('.media--player', $slide)[0]);
          }
        }
      });
    }

    /**
     * Fixes for Focal Point indicator conflict with draggable.
     *
     * @name focalPoint
     */
    function focalPoint() {
      $('*[draggable!=true]', $sliderMain).unbind('dragstart');

      $sliderMain.on('draggable mouseenter mousedown', '.focal-point-indicator', function (e) {
        e.stopPropagation();
      });
    }

    /**
     * Reveal alt and title for just in case required, but left empty.
     *
     * @name onRevealText
     *
     * @param {jQuery.Event} event
     *   The event triggered, most likely a `click` event.
     */
    function onRevealText(event) {
      var form = $form.length ? $form[0] : event.delegateTarget;
      var sbId = $('.is-sb-error', form).attr('id');
      var $slider = $('.sb .slick__slider', form);
      var $text = $('.form-text.required', form);

      if (!$text.length) {
        return;
      }

      // Prevents false negative form validation with hidden cloned.
      $('.slick-cloned .form-text', $slider).removeAttr('required aria-required');

      $text.each(function () {
        var $that = $(this);
        $that.removeClass('error').removeAttr('tabindex');

        if (!this.value) {
          var emptyIndex = parseInt($that.closest('.slide').data('slickIndex'), 0);

          $that.addClass('error');
          $that.closest(_baseWidget).addClass('is-sb-error is-sb-caption');

          if ($slider.length) {
            $slider.slick('slickGoTo', emptyIndex, true);
            $slider.slick('slickPause');
          }
        }
      });

      Drupal.slickBrowser.jump(sbId);
    }

    /**
     * Reacts on Alt/ Title field clicks.
     *
     * @name onTextClick
     *
     * @param {jQuery.Event} e
     *   The event triggered, a `click` event.
     */
    function onTextClick(e) {
      $(e.target).parent().addClass(_isFocused);
    }

    /**
     * Reacts on Alt/ Title field blur event.
     *
     * @name onTextBlur
     *
     * @param {jQuery.Event} e
     *   The event triggered, a `click` event.
     */
    function onTextBlur(e) {
      $(e.target).parent().removeClass(_isFocused);
    }

    cleanUp();

    if ($widget.hasClass('is-sb-1')) {
      $('.slick__slide', widget).addClass('slick-current slick-active');
    }

    if (initialized && !$sbAction.find('.slick__arrow').length) {
      $sliderMain.siblings('.slick__arrow').appendTo($sbAction);
    }

    if (end > 1 && $('.focal-point-indicator', $sliderMain).length) {
      focalPoint();
    }

    // @todo var removedIds = $widget.data('removedId');
    // @todo if (removedIds) {
    // @todo var ids = removedIds.split(' ');
    // @todo $.each(ids, function (i, v) {
    // @todo });
    // @todo }
    $widget.data('deltas', '');

    var cSb = 'click.btnSb';
    var aSb = 'click.altSb';
    var baSb = 'blur.altSb';
    $widget.off(cSb).on(cSb, '.button--sb', onUpdateView);
    $widget.off(aSb).on(aSb, '.js-form-type-textfield input', onTextClick);
    $widget.off(baSb).on(baSb, '.js-form-type-textfield input', onTextBlur);

    onRevealText();

    $form.on('click.btnDo', '#edit-submit', onRevealText);
    updateWidgetHeight();
    $widget.addClass(_onWidget);
  }

  /**
   * Slick Browser sortable utility functions.
   *
   * @param {HTMLElement} elm
   *   The sortable container HTML element.
   */
  function fnSortable(elm) {
    var $elm = $(elm);

    /**
     * Sort the elements.
     *
     * @name sortItems
     *
     * @param {jQuery.Event} event
     *   The event triggered by a `sortable` event.
     */
    function sortItems(event) {
      var $target = $(event.item);
      var $items = $('.sb__sortitem', elm);
      var $widget = $target.closest(_baseWidget);
      var eb = $target.closest('.is-sb-eb').length;
      var ids = [];
      var deltas = [];
      var delta = 0;
      var item;
      var len = $items.length;

      $('.slick', $widget).each(function () {
        var $slider = $('.slick__slider', this);
        if ($slider.hasClass(_slickInitialized)) {
          $slider.slick('unslick');
        }
      });

      // Cleans up unclean unslick.
      $widget.find('.slick__slide.slick-cloned').remove();

      // Update the slick slides to match the new ordered elements.
      for (var i = 0; i < len; i++) {
        item = $items[i];
        delta = $(item).data('rowId');
        deltas[i] = delta;

        $('.sb__weight', item).val(i);
        $('.sb__weight option', item).removeAttr('selected');
        $('.sb__weight option[value="' + i + '"]', item).prop('selected', true).siblings('option').prop('selected', false);

        $widget.find('.slick__slide.slide--' + delta).attr(_dataSlickIndex, i).attr('data-row-id', i);
        $(item).attr('data-row-id', i);

        if (eb) {
          ids[i] = $(item).attr('data-entity-id');
        }
      }

      $widget.data('deltas', deltas);

      // Update entity browser target_id fields.
      if (eb) {
        $widget.siblings('input[type*=hidden][name*="[target_id]"]').val(ids.join(' '));
      }
    }

    Sortable.create(elm, {
      draggable: '.sb__sortitem',
      // @todo filter: 'a, input, .button, .sb__action',
      // @todo handle: '.sb__preview',
      onEnd: sortItems
    });

    $elm.addClass(_onSortable);
  }

  /**
   * Attaches slick browser widget behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserWidget = {
    attach: function (context) {

      var me = Drupal.slickBrowser;
      _d.once(fbWidget, _idWidget, _selWidget, context);
      _d.once(fnSortable, _idSortable, _selSortable, context);

      $(_selSubmit, context).on('mousedown.' + _cAjax, me.loading);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        $(_selSubmit, context).off('.' + _cAjax);

        _d.once.removeSafely(_idWidget, _selWidget, context);
        _d.once.removeSafely(_idSortable, _selSortable, context);
        Drupal.slickBrowser.loaded();
      }
    }
  };

})(jQuery, Drupal, Sortable, dBlazy);
