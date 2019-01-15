/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal) {
  Drupal.AjaxCommands.prototype.editorDialogSave = function (ajax, response, status) {
    $(window).trigger('editor:dialogsave', [response.values]);
  };
})(jQuery, Drupal);;
/**
 * @file
 * Provides JavaScript additions to entity embed dialog.
 *
 * This file provides popup windows for previewing embedded entities from the
 * embed dialog.
 */

(function ($, Drupal) {

  "use strict";

  /**
   * Attach behaviors to links for entities.
   */
  Drupal.behaviors.entityEmbedPreviewEntities = {
    attach: function (context) {
      $(context).find('form.entity-embed-dialog .form-item-entity a').on('click', Drupal.entityEmbedDialog.openInNewWindow);
    },
    detach: function (context) {
      $(context).find('form.entity-embed-dialog .form-item-entity a').off('click', Drupal.entityEmbedDialog.openInNewWindow);
    }
  };

  /**
   * Behaviors for the entityEmbedDialog iframe.
   */
  Drupal.behaviors.entityEmbedDialog = {
    attach: function (context, settings) {
      $('body').once('js-entity-embed-dialog').on('entityBrowserIFrameAppend', function () {
        $('.entity-select-dialog').trigger('resize');
        // Hide the next button, the click is triggered by Drupal.entityEmbedDialog.selectionCompleted.
        $('#drupal-modal').parent().find('.js-button-next').addClass('visually-hidden');
      });
    }
  };

  /**
   * Entity Embed dialog utility functions.
   */
  Drupal.entityEmbedDialog = Drupal.entityEmbedDialog || {
    /**
     * Open links to entities within forms in a new window.
     */
    openInNewWindow: function (event) {
      event.preventDefault();
      $(this).attr('target', '_blank');
      window.open(this.href, 'entityPreview', 'toolbar=0,scrollbars=1,location=1,statusbar=1,menubar=0,resizable=1');
    },
    selectionCompleted: function(event, uuid, entities) {
      $('.entity-select-dialog .js-button-next').click();
    }
  };

})(jQuery, Drupal);
;
/**
 * @file entity_browser.iframe.js
 *
 * Defines the behavior of the entity browser's iFrame display.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * Registers behaviours related to iFrame display.
   */
  Drupal.behaviors.entityBrowserIFrame = {
    attach: function (context) {
      $(context).find('.entity-browser-handle.entity-browser-iframe').once('iframe-click').on('click', Drupal.entityBrowserIFrame.linkClick);
      $(context).find('.entity-browser-handle.entity-browser-iframe').once('iframe-auto-open').each(function () {
        var uuid = $(this).attr('data-uuid');
        if (drupalSettings.entity_browser.iframe[uuid].auto_open) {
          $(this).click();
        }
      });
    }
  };

  Drupal.entityBrowserIFrame = {};

  /**
   * Handles click on "Select entities" link.
   */
  Drupal.entityBrowserIFrame.linkClick = function () {
    var uuid = $(this).attr('data-uuid');
    var original_path = $(this).attr('data-original-path');
    var iframeSettings = drupalSettings['entity_browser']['iframe'][uuid];
    var iframe = $(
      '<iframe />',
      {
        'src': iframeSettings['src'],
        'width': '100%',
        'height': iframeSettings['height'],
        'data-uuid': uuid,
        'data-original-path': original_path,
        'name': 'entity_browser_iframe_' + iframeSettings['entity_browser_id'],
        'id': 'entity_browser_iframe_' + iframeSettings['entity_browser_id']
      }
    );

    var throbber = $('<div class="ajax-progress-fullscreen"></div>');
    $(this).parent().css('width', iframeSettings['width']);

    // Register callbacks.
    if (drupalSettings.entity_browser.iframe[uuid].js_callbacks || false) {
      Drupal.entityBrowser.registerJsCallbacks(this, drupalSettings.entity_browser.iframe[uuid].js_callbacks, 'entities-selected');
    }

    $(this).parent().append(throbber).append(iframe).trigger('entityBrowserIFrameAppend');
    $(this).hide();
  };

}(jQuery, Drupal, drupalSettings));
;