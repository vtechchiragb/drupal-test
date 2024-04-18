/**
 * @file
 * Provides Slick Browser utilitiy functions.
 */

(function ($, Drupal, _d) {

  'use strict';

  var _nick = 'sb';
  var _onSb = _nick + '--on';
  var _onItem = _nick + '-item-container--on';
  var _onDetails = _nick + '--wrapper-hidden--on';
  var _onMediaRendered = 'media--rendered--on';
  var _idSb = _nick;
  var _idItem = _nick + '-item-container';
  var _idDetails = _nick + '-wrapper-hidden';
  var _idMediaRendered = _nick + '-media-rendered';
  var _selSb = '.sb:not(.' + _onSb + ')';
  var _selItem = '.sb .item-container:not(.' + _onItem + ')';
  var _selDetails = '.sb--wrapper-hidden:not(.' + _onDetails + ')';
  var _selMediaRendered = '.media--rendered:not(.' + _onMediaRendered + ')';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Attaches Slick Browser common behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowser = {
    attach: function (context) {
      var me = Drupal.slickBrowser;

      _d.once(me.sb, _idSb, _selSb, context);
      _d.once(me.itemContainer, _idItem, _selItem, context);
      _d.once(me.sbDetails, _idDetails, _selDetails, context);
      _d.once(me.sbMediaRendered, _idMediaRendered, _selMediaRendered, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        $('.sb .item-container', context).find('.button').off('.sbAction');
        _d.once.removeSafely(_idSb, _selSb, context);
        _d.once.removeSafely(_idItem, _selItem, context);
        _d.once.removeSafely(_idDetails, _selDetails, context);
        _d.once.removeSafely(_idMediaRendered, _selMediaRendered, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy);
