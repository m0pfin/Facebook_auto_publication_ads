
<!DOCTYPE html>

<?php

session_start();
if ($_COOKIE["auth"] != "admin_in"){header("location:"."./");}
include __DIR__ . '/../includes/connect.php';
include  __DIR__ . '/../includes/data.php';


$url = $_SERVER["REQUEST_URI"];

$urls = explode("/", $url);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facebook ADS | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Select 2-->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Ion Slider -->
    <link rel="stylesheet" href="../plugins/ion-rangeslider/css/ion.rangeSlider.min.css">


    <!-- Generic page styles -->
    <style>
        #navigation {
            margin: 10px 0;
        }
        @media (max-width: 767px) {
            #title,
            #description {
                display: none;
            }
        }
    </style>
    <!-- blueimp Gallery styles -->
    <link
        rel="stylesheet"
        href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css"
    />
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css" />
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css" />
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript
    ><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"
        /></noscript>
    <noscript
    ><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"
        /></noscript>
</head>
<body>
<div class="container">
    <ul class="nav nav-tabs" id="navigation">
        <li>
            <a href="https://github.com/blueimp/jQuery-File-Upload">Project</a>
        </li>
        <li class="active">
            <a href="#">Demo</a>
        </li>
        <li>
            <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">Wiki</a>
        </li>
        <li>
            <a href="https://blueimp.net">Author</a>
        </li>
    </ul>
    <h1 id="title">jQuery File Upload Demo</h1>
    <blockquote id="description">
        <p>
            File Upload widget with multiple file selection, drag&amp;drop
            support, progress bars, validation and preview images, audio and video
            for jQuery.<br />
            Supports cross-domain, chunked and resumable file uploads and
            client-side image resizing.<br />
            Works with any server-side platform (PHP, Python, Ruby on Rails, Java,
            Node.js, Go etc.) that supports standard HTML form file uploads.
        </p>
    </blockquote>
    <!-- The file upload form used as target for the file upload widget -->
    <form
        id="fileupload"
        action="https://jquery-file-upload.appspot.com/"
        method="POST"
        enctype="multipart/form-data"
    >
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript
        ><input
                type="hidden"
                name="redirect"
                value="https://blueimp.github.io/jQuery-File-Upload/"
            /></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files...</span>
              <input type="file" name="files[]" multiple />
            </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete selected</span>
                </button>
                <input type="checkbox" class="toggle" />
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div
                    class="progress progress-striped active"
                    role="progressbar"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >
                    <div
                        class="progress-bar progress-bar-success"
                        style="width: 0%;"
                    ></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-hover table-bordered">
            <tbody class="files"></tbody>
        </table>
    </form>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Demo Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>
                    The maximum file size for uploads in this demo is
                    <strong>999 KB</strong> (default file size is unlimited).
                </li>
                <li>
                    Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in
                    this demo (by default there is no file type restriction).
                </li>
                <li>
                    Uploaded files will be deleted automatically after
                    <strong>5 minutes or less</strong> (demo files are stored in
                    memory).
                </li>
                <li>
                    You can <strong>drag &amp; drop</strong> files from your desktop
                    on this webpage (see
                    <a
                        href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support"
                    >Browser support</a
                    >).
                </li>
                <li>
                    Please refer to the
                    <a href="https://github.com/blueimp/jQuery-File-Upload"
                    >project website</a
                    >
                    and
                    <a href="https://github.com/blueimp/jQuery-File-Upload/wiki"
                    >documentation</a
                    >
                    for more information.
                </li>
                <li>
                    Built with the
                    <a href="https://getbootstrap.com/">Bootstrap</a> CSS framework
                    and Icons from <a href="https://glyphicons.com/">Glyphicons</a>.
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- The blueimp Gallery widget -->
<div
    id="blueimp-gallery"
    class="blueimp-gallery blueimp-gallery-controls"
    data-filter=":even"
>
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
              <td>
                  <span class="preview"></span>
              </td>
              <td>
                  <p class="name">{%=file.name%}</p>
                  <strong class="error text-danger"></strong>
              </td>
              <td>
                  <p class="size">Processing...</p>
                  <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
              </td>
              <td>
                  {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                    <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                        <i class="glyphicon glyphicon-edit"></i>
                        <span>Edit</span>
                    </button>
                  {% } %}
                  {% if (!i && !o.options.autoUpload) { %}
                      <button class="btn btn-primary start" disabled>
                          <i class="glyphicon glyphicon-upload"></i>
                          <span>Start</span>
                      </button>
                  {% } %}
                  {% if (!i) { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-download fade{%=file.thumbnailUrl?' image':''%}">
              <td>
                  <span class="preview">
                      {% if (file.thumbnailUrl) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                      {% } %}
                  </span>
              </td>
              <td>
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <span class="size">{%=o.formatFileSize(file.size)%}</span>
              </td>
              <td>
                  {% if (file.deleteUrl) { %}
                      <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                          <i class="glyphicon glyphicon-trash"></i>
                          <span>Delete</span>
                      </button>
                      <input type="checkbox" name="delete" value="1" class="toggle">
                  {% } else { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"
    integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
    crossorigin="anonymous"
></script>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
<!-- general form elements disabled -->
</div>
<!-- /.card-body -->
<div class="card-footer">
    Альфа-тест
</div>
<!-- /.card-footer-->
</div>
<!-- /.card -->



<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="https://vk.com/bearded_cpa">M0pfin</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.1
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
        crossorigin="anonymous"
></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/demo.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

</body>
</html>
