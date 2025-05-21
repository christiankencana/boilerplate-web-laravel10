$(function() {
  'use strict'

  if ($(".select2-single").length) {
    $(".select2-single").select2({
      theme: "classic",
      placeholder: 'Select Data',
      allowClear: true
    });
  }
  if ($(".select2-multiple").length) {
    $(".select2-multiple").select2({
      theme: "classic",
      placeholder: 'Select Data',
      allowClear: true
    });
  }
});