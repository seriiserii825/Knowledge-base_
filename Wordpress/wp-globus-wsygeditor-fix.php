<?php

add_filter('wpglobus_plus_acf_remove_empty_p', '__return_true');

// Empty paragraph: <p>&nbsp;</p>, <p> </p>, <p><br></p>, <p> </p> etc.
const AG_EMPTY_P_PATTERN = '<p[^>]*>(?:\s|&nbsp;|&#0*160;|&#x0*a0;|\x{00A0}|<br[^>]*>)*<\/p>';

function ag_clean_empty_paragraphs_segment($content)
{
  $original = $content;

  // Remove orphan </p> at the start
  $content = preg_replace('/^\s*<\/p>/u', '', $content);
  // Remove orphan <p> at the end
  $content = preg_replace('/<p[^>]*>\s*$/u', '', $content);
  // Remove empty paragraphs
  $content = preg_replace('/' . AG_EMPTY_P_PATTERN . '/iu', '', $content);
  // Trim whitespace and non-breaking spaces around content
  $content = preg_replace('/^(?:\s|&nbsp;|\x{00A0})+|(?:\s|&nbsp;|\x{00A0})+$/iu', '', $content);

  // preg_* returns null on invalid UTF-8 — keep original in that case
  return $content === null ? trim($original) : $content;
}

function ag_clean_empty_paragraphs($content)
{
  if (!is_string($content) || $content === '') return $content;

  // WPGlobus multilingual string: {:en}...{:}{:it}...{:} — clean each language separately
  if (preg_match('/\{:[a-zA-Z_-]+\}/', $content)) {
    $cleaned = preg_replace_callback(
      '/(\{:[a-zA-Z_-]+\})(.*?)(\{:\})/s',
      fn($m) => $m[1] . ag_clean_empty_paragraphs_segment($m[2]) . $m[3],
      $content
    );
    return $cleaned === null ? $content : $cleaned;
  }

  return ag_clean_empty_paragraphs_segment($content);
}

// Clean on frontend output (works automatically with get_field)
add_filter('acf/format_value/type=wysiwyg', 'ag_clean_empty_paragraphs', 20);
add_filter('the_content', 'ag_clean_empty_paragraphs', 20);

// Clean on save
add_filter('acf/update_value/type=wysiwyg', 'ag_clean_empty_paragraphs', 999);
add_filter('content_save_pre', 'ag_clean_empty_paragraphs', 999);

// Clean in admin TinyMCE editors (after TinyMCE scripts are printed at priority 50)
add_action('admin_print_footer_scripts', function () {
?>
  <script>
    (function() {
      if (typeof window.tinymce === 'undefined') return;

      var EMPTY_P = '<p[^>]*>(?:\\s|&nbsp;|&#0*160;|&#x0*a0;|\\u00a0|<br[^>]*>)*<\\/p>';
      var reLeading = new RegExp('^(?:\\s*' + EMPTY_P + ')+', 'i');
      var reTrailing = new RegExp('(?:' + EMPTY_P + '\\s*)+$', 'i');
      var reLangSegment = /(\{:[a-zA-Z_-]+\})([\s\S]*?)(\{:\})/g;

      function strip(html) {
        if (typeof html !== 'string' || !html) return html;

        // WPGlobus multilingual string — clean each language separately
        if (/\{:[a-zA-Z_-]+\}/.test(html)) {
          return html.replace(reLangSegment, function(m, open, body, close) {
            return open + strip(body) + close;
          });
        }

        return html.replace(reLeading, '').replace(reTrailing, '').trim();
      }

      function attach(editor) {
        if (!editor || editor.agEmptyPFix) return;
        editor.agEmptyPFix = true;

        // Content loaded into editor (initial load, WPGlobus language switch, Text -> Visual)
        editor.on('BeforeSetContent', function(e) {
          if (e.content) e.content = strip(e.content);
        });

        // Content taken from editor (save, Visual -> Text)
        editor.on('GetContent', function(e) {
          if (e.content) e.content = strip(e.content);
        });
      }

      function cleanLoaded(editor) {
        attach(editor);
        var content = editor.getContent();
        var cleaned = strip(content);
        if (cleaned !== content) {
          editor.setContent(cleaned, { no_events: true });
        }
      }

      // Editors created later (ACF fields, repeaters, flexible content)
      tinymce.on('AddEditor', function(e) {
        attach(e.editor);
      });

      // Editors already created
      (tinymce.editors || []).forEach(attach);

      if (window.jQuery) {
        jQuery(document).on('tinymce-editor-init', function(event, editor) {
          cleanLoaded(editor);
        });
      }
    })();
  </script>
<?php
}, 60);
