import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '400px',
  initialEditType: 'markdown',
    initialValue: document.querySelector('#content').value,
  placeholder: 'Write something cool!',
})
document.querySelector('#formEdit ').addEventListener('submit', e => {
  e.preventDefault();
  document.querySelector('#content').value = editor.getMarkdown();
  e.target.submit();
});

