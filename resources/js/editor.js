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
    if (!document.querySelector('#title').value) {
        alert('Title is required');
        return;
    }
    if (!document.querySelector('#tag').value) {
        alert('Tag is required');
        return;
    }
    document.querySelector('#content').value = editor.getMarkdown();
    if (document.querySelector('#content').value.length < 10) {
        alert('Content is too short');
        return;
    }
    e.target.submit();
});

window.onload = () => {
    const observer = new MutationObserver(() => {
        if (document.querySelector('.toastui-editor-popup.toastui-editor-popup-add-image')) {
            document.querySelector('[aria-label="URL"]').click();
            document.querySelector('[aria-label="File"]').style.display = "none";
        }
    });

    const target = document.querySelector(".toastui-editor-popup ");
    observer.observe(target, {attributes: true, attributeFilter: ["style"]});
}
