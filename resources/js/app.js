
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var $dropzone = $('.image_picker'),
    $droptarget = $('.drop_target'),
    $droptargetmodal = $('.drop_target_modal'),
    $dropinput = $('#inputFile'),
    $dropinputprofile = $('#inputFileProfile'),
    $dropinputmodal = $('#inputFileModal'),
    $dropimg = $('.image_preview'),
    $dropimgmodal = $('.image_preview_modal'),
    $dropimgprofile = $('.image_preview_profile'),
    $remover = $('[data-action="remove_current_image"]');
    $removermodal = $('.remover_modal');

$dropzone.on('dragover', function() {
  $droptarget.addClass('dropping');
  return false;
});

$dropzone.on('dragend dragleave', function() {
  $droptarget.removeClass('dropping');
  return false;
});

$dropzone.on('drop', function(e) {
  $droptarget.removeClass('dropping');
  $droptarget.addClass('dropped');
  $remover.removeClass('disabled');
  e.preventDefault();

  var file = e.originalEvent.dataTransfer.files[0],
      reader = new FileReader();

  reader.onload = function(event) {
    $dropimg.css('background-image', 'url(' + event.target.result + ')').attr('data-image','true');
  };

  console.log(file);
  reader.readAsDataURL(file);

  return false;
});

$dropinput.change(function(e) {
  $droptarget.addClass('dropped');
  $remover.removeClass('disabled');
  $('.image_title input').val('');

  var file = $dropinput.get(0).files[0],
      reader = new FileReader();

  reader.onload = function(event) {
    $dropimg.css('background-image', 'url(' + event.target.result + ')').attr('data-image','true');
  }

  reader.readAsDataURL(file);
});

$dropinputprofile.change(function(e) {
  $droptarget.addClass('dropped');
  $remover.removeClass('disabled');
  $('.image_title input').val('');

  var file = $dropinput.get(0).files[0],
      reader = new FileReader();

  reader.onload = function(event) {
    $dropimgprofile.css('background-image', 'url(' + event.target.result + ')').attr('data-image','true');
  }

  reader.readAsDataURL(file);
});

$dropinputmodal.change(function(e) {
    $droptargetmodal.addClass('dropped');
    $removermodal.removeClass('disabled');
    $('.image_title input').val('');
    $('.thumbnail-preview').css('visibility','hidden');
    $('.label-image').addClass('margin-top');

    var file = $dropinputmodal.get(0).files[0],
        reader = new FileReader();

    reader.onload = function(event) {
      $dropimgmodal.css('background-image', 'url(' + event.target.result + ')').attr('data-image','true');
    }

    reader.readAsDataURL(file);
  });

$remover.on('click', function() {
  $dropimg.css('background-image', '').removeAttr("data-image");
  $droptarget.removeClass('dropped');
  $remover.addClass('disabled');
  $('.image_title input').val('');
  $('.thumbnail-preview').css('visibility','visible');
  $('.label-image').removeClass('margin-top');
});

$('.image_title input').blur(function() {
  if ($(this).val() != '') {
    $droptarget.removeClass('dropped');
  }
});
