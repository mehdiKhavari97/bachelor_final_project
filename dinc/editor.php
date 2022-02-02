<form method="get">



<link rel='stylesheet' href='https://cdn.quilljs.com/1.0.0-beta.6/quill.snow.css'>
<!-- partial:index.partial.html -->
<div class="quill-wrap">
<!-- Create the toolbar container -->
<div id="toolbar">
      <span class="ql-formats">
        <select class="ql-header">
          <option value="1">Heading</option>
          <option value="2">Subheading</option>
          <option selected>Normal</option>
        </select>
        <select class="ql-font">
          <option selected>Sans Serif</option>
          <option value="serif">Serif</option>
          <option value="monospace">Monospace</option>
        </select>
      </span>
      <span class="ql-formats">
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button class="ql-underline"></button>
        <button class="ql-strike"></button>
      </span>
      <span class="ql-formats">
        <select class="ql-color"></select>
        <select class="ql-background"></select>
      </span>
      <span class="ql-formats">
        <button class="ql-list" value="ordered"></button>
        <button class="ql-list" value="bullet"></button>
        <select class="ql-align">
          <option selected></option>
          <option value="center"></option>
          <option value="right"></option>
          <option value="justify"></option>
        </select>
      </span>
      <span class="ql-formats">
        <button class="ql-blockquote"></button>
        <button class="ql-link"></button>
        <button class="ql-image"></button>
        <button class="ql-code-block"></button>
        <button class="ql-video"></button>
      </span>
      <span class="ql-formats">
        <button class="ql-clean"></button>
      </span>
</div>

<!-- Create the editor container -->
<div id="editor">
<p class="ql-align-center"><strong>Hello World!</strong> Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! <strong style="color: rgb(0, 97, 0);">Hello</strong> World! Hello World! Hello World! Hello World! Hello World! Hello World! <em>Hello</em> World! Hello World! <strong class="ql-font-monospace" style="background-color: rgb(255, 153, 0); color: rgb(0, 71, 178);">Hello World!</strong> Hello World! Hello World! Hello World! Hello World! Hello World! Hello <u>World</u>! Hello World! Hello World! Hello World! Hello <s>World</s>! Hello World! Hello World! Hello World!</p><p><br></p><blockquote>Hello again! <u>This is a block quote</u>.</blockquote><p><br></p><ol><li>one</li><li>two</li><li><a href="https://www.google/search?q=QuillJS" target="_blank">google</a></li></ol><p><br></p><ul><li>one</li><li>two</li><li>three</li></ul><p><br></p><pre spellcheck="false">// this is code.</pre><p class="ql-align-center"><img src="https://quilljs.com/images/browsers.png"></p><h1><span class="ql-font-monospace">Goodbye.</span></h1>
</div>
</div>
<script src='https://cdn.quilljs.com/1.0.0-beta.6/quill.js'></script>
<script type="text/javascript">
var editor = new Quill('#editor', {
    modules: { toolbar: '#toolbar' },
    theme: 'snow'
});

var form = document.querySelector('form');
form.onsubmit = function() {
  // Populate hidden form on submit
  var about = document.querySelector('input[name=about]');
  about.value = JSON.stringify(quill.getContents());
  
  console.log("Submitted", $(form).serialize(), $(form).serializeArray());

</script>
<input type="submit">
</form>