var LolitaFramework;
(function (LolitaFramework) {
    var DataGenerator = (function () {
        function DataGenerator() {
            var _this = this;
            this.api = null;
            this.api = window.wp.customize;
            jQuery(document).on('click', '#sample_data_generator_post_generate', function (e) { return _this.generatePosts(e); });
        }
        DataGenerator.prototype.generatePosts = function (e) {
            e.preventDefault();
            var request;
            window.LolitaFramework.css_loader.show(8);
            request = window.wp.ajax.send('generate_posts', {
                data: {
                    nonce: window.lolita_framework.LF_NONCE,
                    count: this.api.instance('sample_data_generator_post_count').get(),
                    post_type: this.api.instance('sample_data_generator_post_post_type').get(),
                    post_title: this.api.instance('sample_data_generator_post_custom_title').get(),
                    post_content: this.api.instance('sample_data_generator_post_custom_content').get(),
                    post_excerpt: this.api.instance('sample_data_generator_post_custom_excerpt').get(),
                    image_type: this.api.instance('sample_data_generator_post_featured_image_type').get(),
                    image_id: this.getImageID('sample_data_generator_post_featured_image'),
                    meta: this.api.instance('sample_data_generator_post_meta_data').get()
                },
                type: "GET"
            });
            request.always(function () {
                window.LolitaFramework.css_loader.hide();
            });
        };
        DataGenerator.prototype.getImageID = function (control_name) {
            var id;
            try {
                id = this.api.control('sample_data_generator_post_featured_image').params.attachment.id;
            }
            catch (err) {
                id = 0;
            }
            return id;
        };
        return DataGenerator;
    }());
    LolitaFramework.DataGenerator = DataGenerator;
    window.LolitaFramework.data_generator = new DataGenerator();
})(LolitaFramework || (LolitaFramework = {}));
//# sourceMappingURL=data_generator.js.map