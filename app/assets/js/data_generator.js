var LolitaFramework;
(function (LolitaFramework) {
    var DataGeneratorPost = (function () {
        function DataGeneratorPost() {
            var _this = this;
            this.api = null;
            this.api = window.wp.customize;
            jQuery(document).on('click', '#sample_data_generator_post_generate', function (e) { return _this.generatePosts(e); });
            jQuery(document).on('click', '#sample_data_generator_post_deleta_all', function (e) { return _this.deletePosts(e); });
        }
        DataGeneratorPost.prototype.generatePosts = function (e) {
            e.preventDefault();
            var request;
            window.LolitaFramework.css_loader.show(8);
            request = window.wp.ajax.post('generate_posts', {
                nonce: window.lolita_framework.LF_NONCE,
                unique: this.api.instance('sample_data_generator_post_unique').get(),
                count: this.api.instance('sample_data_generator_post_count').get(),
                post_type: this.api.instance('sample_data_generator_post_post_type').get(),
                post_title: this.api.instance('sample_data_generator_post_custom_title').get(),
                post_content: this.api.instance('sample_data_generator_post_custom_content').get(),
                post_excerpt: this.api.instance('sample_data_generator_post_custom_excerpt').get(),
                image_type: this.api.instance('sample_data_generator_post_featured_image_type').get(),
                image_id: this.getImageID('sample_data_generator_post_featured_image'),
                meta: this.api.instance('sample_data_generator_post_meta_data').get()
            });
            request.always(function () {
                window.LolitaFramework.css_loader.hide();
            });
        };
        DataGeneratorPost.prototype.deletePosts = function (e) {
            e.preventDefault();
            var request;
            if (confirm('Are you sure to delete all posts?') == true) {
                window.LolitaFramework.css_loader.show(8);
                request = window.wp.ajax.post('delete_posts', {
                    nonce: window.lolita_framework.LF_NONCE,
                    post_type: this.api.instance('sample_data_generator_post_post_type').get()
                });
                request.always(function () {
                    window.LolitaFramework.css_loader.hide();
                });
            }
        };
        DataGeneratorPost.prototype.getImageID = function (control_name) {
            var id;
            try {
                id = this.api.control('sample_data_generator_post_featured_image').params.attachment.id;
            }
            catch (err) {
                id = 0;
            }
            return id;
        };
        return DataGeneratorPost;
    }());
    LolitaFramework.DataGeneratorPost = DataGeneratorPost;
    window.LolitaFramework.data_generator_post = new DataGeneratorPost();
})(LolitaFramework || (LolitaFramework = {}));
//# sourceMappingURL=data_generator.js.map