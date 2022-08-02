import app from 'flarum/app';

app.initializers.add('exercisebook-fof-upload-imagex', function (app) {

    const setting = (s) => app.translator.trans(`exercisebook-fof-upload-imagex.imagexConfig.${s}`)
    const label = (s) => app.translator.trans(`exercisebook-fof-upload-imagex.admin.labels.imagexLabel.${s}`)
    const help = (s) => app.translator.trans(`exercisebook-fof-upload-imagex.admin.labels.imagexHelp.${s}`)

    app.extensionData
        .for('exercisebook-fof-upload-imagex')
        .registerSetting(
            {
                setting: setting('accessKey'),
                label: label('accessKey'),
                help: help('accessKey'),
                type: 'text',
            },
            1010
        )
        .registerSetting(
            {
                setting: setting('secretKey'),
                label: label('secretKey'),
                help: help('secretKey'),
                type: 'text',
            },
            1000
        )

        .registerSetting(
            {
                setting: setting('region'),
                label: label('region'),
                help: help('region'),
                type: 'select',
                options: {
                    'cn-north-1': label('regionOption.cn-north-1'),
                    'us-east-1': label('regionOption.us-east-1'),
                    'ap-singapore-1': label('regionOption.ap-singapore-1'),
                },
                default: 'cn-north-1',
            },
            550
        )

        .registerSetting(
            {
                setting: setting('serviceId'),
                label: label('serviceId'),
                help: help('serviceId'),
                type: 'text',
            },
            540
        )
        .registerSetting(
            {
                setting: setting('domain'),
                label: label('domain'),
                help: help('domain'),
                type: 'text',
            },
            530
        )

        .registerSetting(
            {
                setting: setting('imagePreviewTemplate'),
                label: label('imagePreviewTemplate'),
                help: help('imagePreviewTemplate'),
                type: 'text',
            },
            510
        )
        .registerSetting(
            {
                setting: setting('imageFullscreenTemplate'),
                label: label('imageFullscreenTemplate'),
                help: help('imageFullscreenTemplate'),
                type: 'text',
            },
            500
        )

        .registerSetting(
            {
                setting: setting('fileRetrievingSignatureToken'),
                label: label('fileRetrievingSignatureToken'),
                help: help('fileRetrievingSignatureToken'),
                type: 'text',
            },
            400
        )
});