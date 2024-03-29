import app from 'flarum/forum/app';
import {extend} from 'flarum/common/extend';
import Post from 'flarum/forum/components/Post';

/* global $ */

export default function () {
  extend(Post.prototype, 'oncreate', function () {
    this.$('[data-fof-imagex-upload-download-uuid]')
      .unbind('click')
      .on('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (!app.forum.attribute('fof-upload.canDownload')) {
          alert(app.translator.trans('fof-upload.forum.states.unauthorized'));
          return;
        }

        let url = app.forum.attribute('apiUrl') + '/exercisebook/fof-imagex/download';

        url += '/' + encodeURIComponent(e.currentTarget.dataset.fofImagexUploadDownloadUuid);
        url += '/' + encodeURIComponent(this.attrs.post.id());
        url += '/' + encodeURIComponent(app.session.csrfToken);

        window.open(url);
      });
  });
}
