/**
 * @file
 * Provides Slick Browser media switch utilitiy functions.
 *
 * This can be used for both Slick browsers and widgets.
 */

(function ($, Drupal, _d, _win) {

  'use strict';

  var _nick = 'sb';
  var _root = '.' + _nick;
  var _wrapper = _root + '--wrapper';
  var _rootForm = '.form--' + _nick;
  var _isNick = 'is-' + _nick;
  var _idMedia = _nick + '-media';
  var _onMedia = _idMedia + '--on';
  var _selPlayer = '.media--player';
  var _element = _root + ' ' + _selPlayer + ':not(.' + _onMedia + ')';
  var _isPlaying = 'is-playing';
  var _isZoom = _isNick + '-zoom';
  var _isZoomed = _isNick + '-zoomed';
  var _cZoom = _nick + '__zoom';

  Drupal.slickBrowser = Drupal.slickBrowser || {};

  /**
   * Slick Browser media utility functions.
   *
   * @param {HTMLElement} media
   *   The media player HTML element.
   */
  function fnMedia(media) {
    var $media = $(media);
    var $form = $media.closest(_rootForm);
    var $sb = $form.length ? $form : $media.closest(_wrapper);
    var $zoom = $('.' + _cZoom, $sb);
    var $body = $sb.closest('body');
    var $wParent = _win.parent.document;
    var id = 'sb-target';
    var wpad = Math.round((($(_win).height() / $(_win).width()) * 100), 2) + '%';

    if (!$zoom.length && $form.length) {
      $form.append('<div class="' + _cZoom + '" />');
      $zoom = $('.' + _cZoom, $form);
    }

    /**
     * Play the media.
     *
     * @param {jQuery.Event} e
     *   The event triggered by a `click` event.
     */
    function play(e) {
      var $btn = $(e.currentTarget);
      var $current = $btn.closest(_selPlayer);

      $body.addClass(_isZoom);
      $sb.addClass(_isZoomed);

      setTimeout(function () {
        if ($zoom.length && !$(_selPlayer, $zoom).length) {
          var $clone = $current.clone(true, true);
          $clone.appendTo($zoom);
          $clone.find('img').remove();
          $clone.css('padding-bottom', wpad);
          $current.find('iframe').remove();
        }

        if ($form.length) {
          $('.ui-dialog:visible', $wParent).addClass('ui-dialog--zoom');
        }
        else {
          Drupal.slickBrowser.jump(id);
        }
      });
    }

    /**
     * Close the media.
     *
     * @param {jQuery.Event} e
     *   The event triggered by a `click` event.
     */
    function stop(e) {
      $('.' + _isPlaying).removeClass(_isPlaying);

      $zoom.empty();
      $body.removeClass(_isZoom);
      $sb.removeClass(_isZoomed);

      if ($form.length) {
        $('.ui-dialog:visible', $wParent).removeClass('ui-dialog--zoom');
      }
    }

    var cPlay = 'click.sbMediaPlay';
    var cStop = 'click.sbMediaClose';
    $media.off(cPlay).on(cPlay, '.media__icon--play', play);
    $media.off(cStop).on(cStop, '.media__icon--close', stop);
    $media.addClass(_onMedia);
  }

  /**
   * Attaches Slick Browser media behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.slickBrowserMedia = {
    attach: function (context) {
      _d.once(fnMedia, _idMedia, _element, context);
    },
    detach: function (context, setting, trigger) {
      if (trigger === 'unload') {
        _d.once.removeSafely(_idMedia, _element, context);
      }
    }
  };

})(jQuery, Drupal, dBlazy, this);
