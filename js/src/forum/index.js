import app from 'flarum/forum/app';

import downloadButtonInteraction from './downloadButtonInteraction';

app.initializers.add('exercisebook-fof-upload-imagex', () => {
  downloadButtonInteraction();
});
