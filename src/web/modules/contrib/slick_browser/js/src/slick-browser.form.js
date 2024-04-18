/**
 * @file
 * Provides Slick Browser utilitiy functions.
 */

(function ($, Drupal, _d, _win) {

  'use strict';

  var _nick = 'sb';
  var _ebs = 'entity_browser_select';
  var _isNick = 'is-' + _nick;
  var _idForm = _nick + '-form';
  var _onForm = 'form--sb--on';
  var _selForm = '.form--sb:not(.' + _onForm + ')';
  var _entitiesList = 'entities-list';
  var _idEntitiesList = _nick + '-' + _entitiesList;
  var _onEntitiesList = _entitiesList + '--on';
  var _selEntitiesList = '.' + _entitiesList + ':not(.' + _onEntitiesList + ')';
  var _selEditSelected = '#edit-selected';
  var _sbCounter = 'sbCounter';
  var _isMarked = _isNick + '-marked';
  var _isChecked = _isNick + '-checked';
  var _selMarked = '.' + _isMarked;
  var _selChecked = '.' + _isChecked;
  var _isMarkedChecked = _isMarked + ' ' + _isChecked;
  var _isEmpty = _isNick + '-empty';
  var _isCollapsed = _isNick + '-collapsed';
  var _wasChecked = 'was-sb-checked';
  var _checked = 'checked';
  var _disabled = 'disabled';
  var _cItemContainer = 'item-container';
  var _selItemContainer = '.' + _cItemContainer;
  var _cardinality = 'cardinality';
  var _overlimit = 'form--overlimit';
  var _dataEntity = 'data-entity';
  var _dataEntityId = _dataEntity + '-id';
  var _img = 'img';
  var _selMessages = '.messages';
  var _selBtnShow = '.button-wrap--show-selection';
  var _selVFSelection = '.views-field--selection';
  var _selGrid = '.grid';
  var _btnSelect = '.button--select';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Slick Browser utility functions.
   *
   * @namespace
   */
  Drupal.slickBrowser.form = Drupal.slickBrowser.form || {

    $form: null,

    /**
     * Checks if selection is empty.
     *
     * @return {bool}
     *   True if a selection is not available, else false.
     */
    isEmpty: function () {
      return !$(_selEditSelected, this.$form).children().length;
    },

    /**
     * Do something if selection is empty.
     */
    doEmpty: function () {
      // @todo $(_selBtnShow, $footer)[$form.hasClass('form--tabs-v') ? 'show' : 'hide']();
      this.$form.addClass(_isEmpty + ' ' + _isCollapsed);
    },

    /**
     * Remove empty marker whenever an item is selected, or uploaded.
     */
    noLongerEmpty: function () {
      this.$form.removeClass(_isEmpty);
    },

    /**
     * Remove empty marker whenever an item is selected, or uploaded.
     */
    onUpload: function () {
      this.noLongerEmpty();
    },

    /**
     * Toggle selection counter.
     */
    toggleCounter: function () {
      var me = this;
      var cardinality = me.$form.data(_cardinality) || -1;
      var $editSelected = $(_selEditSelected, me.$form);
      var $counter = $('#edit-counter', me.$form);

      // Only multistep display has selection, so do nothing.
      if ($editSelected.length) {
        var _selectedCount = $editSelected.children().length;
        var total = cardinality === -1 ? 'unlimited' : cardinality;
        var text = Drupal.formatPlural(_selectedCount, '1', '@count');

        text += ' ' + Drupal.formatPlural(total, 'of 1 item selected', 'of @count items selected');

        if (me.$form.hasClass(_overlimit)) {
          text += ' ' + Drupal.t('(Remove one to select another)');
          $counter.text(_selectedCount > 0 ? text : '');
        }
        else {
          $counter.text(_selectedCount > 0 ? text : '');
        }

        if (me.isEmpty()) {
          me.doEmpty();
        }
      }
    },

    /**
     * Marks selected item enabled or disabled.
     *
     * @param {string} value
     *   The checkbox value.
     * @param {boolean} enabled
     *   Whether to enable or disable.
     */
    toggleSelected: function (value, enabled) {
      var $input = $('input[name="' + _ebs + '[' + value + ']"]');
      var txt = enabled ? '' : Drupal.t('Was selected');
      var $grid;

      if ($input.length) {
        $grid = $input.closest(_selGrid);
        if (enabled) {
          $input.prop(_checked, false).removeAttr(_disabled);
          $grid.removeClass(_isMarkedChecked + ' ' + _wasChecked);
        }
        else {
          $input.prop(_checked, true).attr(_disabled, _disabled);
          $grid.addClass(_isMarked + ' ' + _wasChecked);
        }

        if ($grid.find(_img).length) {
          $grid.find(_img).attr('title', txt);
        }
        else {
          $grid.attr('title', txt);
        }
      }
    }

  };

  /**
   * Slick Browser utility functions.
   *
   * @param {HTMLElement} form
   *   The Entity Browser form HTML element.
   */
  function fnForm(form) {
    var me = Drupal.slickBrowser.form;
    var $form = $(form);
    var $body = $form.closest('body');
    var $wParent = $(_win.parent.document);
    var $dialog = $('.ui-dialog:visible', $wParent);
    // @todo var $footer = $('#edit-footer', form);
    var $checkBox = $('input[name*="' + _ebs + '"]', form);
    var $btnUse = $('.button[name="use_selected"]', form);
    var txtUse = $btnUse.length ? $btnUse.val() : Drupal.t('Add to Page');
    var clonedUse = '#edit-use-selected-clone';
    var $editSelected = $(_selEditSelected, form).removeClass('hidden');
    var cardinality = $form.data(_cardinality) || -1;

    me.$form = $form;

    if ($('.sb__radios', form).length) {
      $form.addClass('form--media-bundle-selection');
    }

    /**
     * Selects item within Entity Browser iframes.
     *
     * @param {jQuery.Event} event
     *   The event triggered by a `click` event.
     *
     * @return {bool}|{mixed}
     *   Return false if no context available.
     */
    function onAddItem(event) {
      event.preventDefault();

      var grid = event.currentTarget;

      checkItem(grid);

      // Only multistep display has selection, so do nothing.
      if (!$editSelected.length) {
        $form.addClass(_isCollapsed);
        return false;
      }
      else {
        $editSelected.trigger('change.' + _sbCounter);
      }

      // Show the selection button.
      $(_selBtnShow, form).show();

      // Refresh selection sortable.
      // @todo figure out replacement for deprecated $editSelected.sortable('refresh');
      $form.removeClass(_isCollapsed);
    }

    /**
     * Clones item into selection display.
     *
     * @param {HTMLElement} grid
     *   The grid HTML element.
     */
    function cloneItem(grid) {
      var $grid = $(grid);
      var $input = $('input[name^="' + _ebs + '"]', grid);
      var entity = $input.val();
      var split = entity.split(':');
      var id = split[1];
      var $img = $(_img, grid);
      var thumb = $('.media', grid).data('thumb');
      // @todo proper preview selection.
      var $txt = $(_selVFSelection, grid).length ? $(_selVFSelection, grid) : $('.views-field:nth-child(2)', grid);
      var $clone = null;

      me.noLongerEmpty();

      $grid.attr(_dataEntityId, id).attr(_dataEntity, entity);

      // If it has thumbnails.
      if (thumb) {
        $clone = $('<img src="' + thumb + '" alt="' + Drupal.t('Thumbnail') + '">');
      }
      // If it has images.
      else if ($img.length) {
        $clone = $img;
      }
      // If it has no images, and has a special class .views-field--selection.
      // @todo fault proof.
      else if ($txt.length) {
        $clone = $txt;
      }

      if ($clone === null) {
        return;
      }

      // Only multistep display has selection, so do nothing.
      if (!$editSelected.length) {
        return;
      }

      // @todo recheck dups.
      var cloned = $clone.clone();
      if (!cloned.closest(_selItemContainer).length) {
        cloned
          .addClass('item-selected')
          .detach()
          .appendTo($editSelected)
          .wrapAll('<div class="' + _cItemContainer + '" ' + _dataEntityId + '="' + id + '" ' + _dataEntity + '="' + entity + '" />');
      }

      // Adds dummy elements for quick interaction.
      var $weight = '<input class="weight" value="" type="hidden" />';
      var $remove = '<span class="button-wrap button-wrap--remove"><input value="Remove" class="button button--remove button--remove-js" type="button"></span>';
      $(_selItemContainer, $editSelected).each(function (i) {
        var t = $(this);

        if (!$('.weight', t).length) {
          t.append($remove);
          t.append($weight);

          $('.button--remove', t).attr(_dataEntityId, id).attr(_dataEntity, entity).attr('data-remove-entity', 'items_' + entity).attr('name', 'remove_' + id + '_' + i);
          // <input class="weight" data-drupal-selector="edit-selected-items-220-0-weight" type="hidden" name="selected[items_220_0][weight]" value="0">
          $('.weight', t).val(i).attr('name', 'selected[items_' + id + '_' + i + '][weight]').attr('data-drupal-selector', 'edit-selected-items-' + id + '-' + i + '-weight');
        }
      });

      // Remove the clone when the input is unchecked.
      if (!$input.prop(_checked)) {
        $editSelected.find(_selItemContainer + '[' + _dataEntityId + '="' + id + '"]').remove();
      }
    }

    /**
     * Check the EB input when the outer element is clicked.
     *
     * @param {HTMLElement} grid
     *   The grid HTML element.
     *
     * @return {bool}
     *   Return false if not applicable.
     */
    function checkItem(grid) {
      var $grid = $(grid);
      var input = 'input[name^="' + _ebs + '"]';
      var $input = $(input, grid);
      var entity = $input.val();
      var split = entity.split(':');
      var id = split[1];
      var $view = $grid.closest('.view--sb');

      me.noLongerEmpty();

      var checkOne = function () {
        $input.prop(_checked, !$input.prop(_checked)).attr(_dataEntityId, id).attr(_dataEntity, entity);
        $grid[$input.prop(_checked) ? 'addClass' : 'removeClass'](_isMarkedChecked);

        $(_btnSelect, grid).html($input.prop(_checked) ? '&#10003;' : '&#43;');
      };

      var uncheckOne = function () {
        $input.prop(_checked, false);
        $grid.removeClass(_isMarkedChecked);
        $(_btnSelect, grid).html('&#43;');

        if ($editSelected.length) {
          $editSelected.find(_selItemContainer + '[' + _dataEntityId + '="' + id + '"]').remove();
        }
      };

      var resetAll = function () {
        $(input).not($grid.find('input')).prop(_checked, false);
        $view.find(_selGrid).not(this).removeClass(_isMarkedChecked);
      };

      var checkAndClone = function () {
        checkOne();
        cloneItem(grid);
      };

      switch (cardinality) {
        case 1:
          // Do not proceed if one is already stored, until removed.
          if ($view.find('.' + _wasChecked).length) {
            $form.addClass(_overlimit);
            return false;
          }

          $form.removeClass(_overlimit);
          resetAll();
          checkAndClone();

          // Remove anything else but the new one selected.
          if ($editSelected.length) {
            $editSelected.find('.item-container:not([' + _dataEntityId + '="' + id + '"])').remove();
          }
          break;

        case -1:
          checkAndClone();
          break;

        default:
          var total = $view.find(_selChecked).length;
          // Only multistep display has selection, so still check it.
          if ($editSelected.length && $editSelected.children().length) {
            total = $editSelected.children().length;
          }

          $form[total === cardinality ? 'addClass' : 'removeClass'](_overlimit);
          if (total >= cardinality) {
            // @todo resetOne, checkOne? Or let the user remove one instead?
            if ($grid.hasClass(_isChecked)) {
              uncheckOne();
              $form.removeClass(_overlimit);
            }
            else {
              $form.addClass(_overlimit);
            }
            return false;
          }
          else {
            checkAndClone();
          }
          break;
      }
    }

    /**
     * Removes item within Entity Browser selection display.
     *
     * @param {jQuery.Event} event
     *   The event triggered by a `click` event.
     */
    function onRemoveItem(event) {
      event.preventDefault();

      var $btn = $(event.currentTarget);
      var $item = $btn.closest(_selItemContainer);
      var entity = $item.data('entity');
      var $input = $form.find('input[name="' + _ebs + '[' + entity + ']"]');
      var $marked = $form.find(_selMarked + '[' + _dataEntity + '="' + entity + '"]');

      // Remove markers from input container.
      $marked.removeClass(_isMarkedChecked);

      $input.prop(_checked, false).closest(_selChecked).removeClass(_isMarkedChecked);

      // Remove selection item as well.
      $item.remove();
      $form.removeClass(_overlimit);
      $(_btnSelect, $marked).html('&#43;');

      if ($editSelected.length) {
        $editSelected.trigger('change.' + _sbCounter);
      }

      if (me.isEmpty()) {
        me.doEmpty();
      }
    }

    /**
     * Toggles the selection displays.
     */
    function onToggleSelection() {
      $form.toggleClass(_isCollapsed);
    }

    /**
     * Dialog actions.
     */
    function doDialog() {
      var $fake = $('<button id="edit-use-selected-clone" class="button button--primary button--sb button--use-selected-clone">' + txtUse + '</button>');
      var $close = $dialog.eq(0).find('.ui-dialog-titlebar-close');

      if ($btnUse.length && !$dialog.find(clonedUse).length) {
        $fake.insertBefore($close);
      }

      $dialog.on('click.sbDialogInsert', clonedUse, function (e) {
        $(e.delegateTarget).addClass('is-b-loading');
        $btnUse.click();
      });
    }

    /**
     * Remove annoying messages on small window by clicking it.
     *
     * @param {Event} e
     *   The click event.
     */
    function onCloseMessages(e) {
      $(e.target).remove();
    }

    /**
     * Finalizes the form actions.
     */
    function fnFinalize() {
      // Remove giant dup messages since we are on small windows, need room.
      // Not needed by claro.
      // _win.clearTimeout(_messageTimer);
      // _messageTimer = _win.setTimeout(function () {
      // $(_selMessages, $body).remove();
      // }, 12000);
      $body.addClass('sb-body');
      $('> div:not(.sb__aside)', form).addClass('sb__main');

      // Only proceed if we have selections.
      if (me.isEmpty()) {
        me.doEmpty();
        if ($dialog.length) {
          $dialog.find(clonedUse).remove();
        }
        return;
      }

      // Do dialog stuffs.
      if ($dialog.length) {
        doDialog();
      }

      $(clonedUse).text(txtUse).removeClass('visually-hidden');

      // This selection can be loaded anywhere out of Views, form upload, etc.
      if (!$checkBox.length) {
        return;
      }

      me.noLongerEmpty();
    }

    // Events.
    $form.on('click.sbGrid', '.grid:not(.view-list--header, .' + _wasChecked + ')', onAddItem);
    $form.on('click.sbRemove', '.button--remove-js', onRemoveItem);
    // button--show-selection
    $form.on('click.sbShow', '.entity-browser-show-selection', onToggleSelection);
    $form.on('click.sbUpload', '.js-form-file, .dz-clickable', me.onUpload.bind(me));
    $form.on('click.sbInsert', '#edit-use-selected', Drupal.slickBrowser.loading);
    $form.on('click.sbSubmit', '#edit-submit', Drupal.slickBrowser.loading);
    $body.on('click.sbMessage', _selMessages, onCloseMessages);

    fnFinalize();
    $form.addClass(_onForm);
  }

  /**
   * Slick Browser utility functions.
   *
   * @param {HTMLElement} elm
   *   The #edit-selected HTML element.
   */
  function fnEntitiesList(elm) {
    var me = Drupal.slickBrowser.form;
    var $elm = $(elm);
    var $form = $elm.closest('form');
    var targetType = $form.data('targetType');

    me.$form = $form;

    $elm.children().each(function (i, item) {
      var $item = $(item);
      var id = $item.data('entityId');
      var $input = $('input', item);
      var value = targetType + ':' + id;

      // @todo $input.attr(_dataEntity, value);
      me.toggleSelected(value, false);
      $input.on('mousedown', function () {
        me.toggleSelected(value, true);

        // Should listen to ajaxing, maybe later.
        _win.setTimeout(function () {
          $elm.trigger('change.' + _sbCounter);
        }, 300);
      });
    });

    var checkCounter = function () {
      me.toggleCounter();
    };

    checkCounter();
    $elm.on('change.' + _sbCounter, checkCounter);
    $elm.addClass(_onEntitiesList);
  }

  /**
   * Attaches Slick Browser form behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserForm = {
    attach: function (context) {
      _d.once(fnForm, _idForm, _selForm, context);
      _d.once(fnEntitiesList, _idEntitiesList, _selEntitiesList, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        _d.once.removeSafely(_idForm, _selForm, context);
        _d.once.removeSafely(_idEntitiesList, _selEntitiesList, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy, this);
