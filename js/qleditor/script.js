        var toolbarOptions = [
                                ['italic', 'bold'],
                                [{'color': ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", 'custom-color']}],
                                ['link', 'image'],
                                [{'align': 'justify'}],
                                [{'align': 'center'}, {'align': 'right'}],
                                ['blockquote', 'code-block'],
                                [{'header': 2}],
                                ['showHtml'],

        ];

        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: toolbarOptions,
                    handlers: {
                        image: imageHandler
                    }
                }
            },
            placeholder: 'متن اصلی...',
            theme: 'snow',
            direction: 'rtl'
        });

        function imageHandler() {
            var range = this.quill.getSelection();
            var value = prompt('What is the image URL');
            if(value){
                this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
            }
        }

var txtArea = document.createElement('textarea');
txtArea.style.cssText = "width: 100%;margin: 0px;background: rgb(29, 29, 29); direction:ltr; box-sizing: border-box;color: rgb(204, 204, 204);font-size: 15px;outline: none;padding: 20px;line-height: 24px;font-family: Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace;position: absolute;top: 0;bottom: 0;border: none;display:none"

var htmlEditor = quill.addContainer('ql-custom')
htmlEditor.appendChild(txtArea)

var myEditor = document.querySelector('#editor-container')
quill.on('text-change', (delta, oldDelta, source) => {
  var html = myEditor.children[0].innerHTML
  txtArea.value = html
})

var customButton = document.querySelector('.ql-showHtml');
customButton.addEventListener('click', function() {
  if (txtArea.style.display === '') {
    var html = txtArea.value
    self.quill.pasteHTML(html)
  }
  txtArea.style.display = txtArea.style.display === 'none' ? '' : 'none'
});

var form = document.querySelector('form');
form.onsubmit = function() {
  // Populate hidden form on submit
  var content = document.querySelector('input[name=content]');
  content.value = JSON.stringify(quill.getContents());
  content.value = quill.root.innerHTML;

  //console.log(content.value.convertTo('html'));
  
  //var editor_content = Quill.root.innerHTML;

  // No back end to actually submit to!
  //alert( convertTo('html',content.value) );

  //var justHtml = quill.root.innerHTML;
  
  //console.log("Submitted", $(form).serialize(), $(form).serializeArray());

  //alert( justHtml );
  //return false;
};