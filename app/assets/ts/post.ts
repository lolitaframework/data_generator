/// <reference path="jquery.d.ts" />

namespace LolitaFramework {
    export class DataGeneratorPost {

        /**
         * WP customize
         * @type {any}
         */
        api: any = null;

        /**
         * Repeaters controls
         */
        constructor() {
            this.api = (<any>window).wp.customize;
            jQuery(document).on(
                'click',
                '#data_generator_post_generate',
                (e:any) => this.generatePosts(e)
            );

            jQuery(document).on(
                'click',
                '#data_generator_post_deleta_all',
                (e:any) => this.deletePosts(e)
            );
        }

        /**
         * Generate posts
         * @param {any} e [description]
         */
        generatePosts(e:any) {
            e.preventDefault();

            var request:any;

            (<any>window).LolitaFramework.css_loader.show(8);

            request = (<any>window).wp.ajax.post(
                'generate_posts',
                {
                    nonce: (<any>window).lolita_framework.LF_NONCE,
                    count: this.api.instance('data_generator_post_count').get(),
                    post_type: this.api.instance('data_generator_post_post_type').get(),
                    post_title: this.api.instance('data_generator_post_custom_title').get(),
                    post_content: this.api.instance('data_generator_post_custom_content').get(),
                    post_excerpt: this.api.instance('data_generator_post_custom_excerpt').get(),
                    image_type: this.api.instance('data_generator_post_featured_image_type').get(),
                    image_id: this.getImageID('data_generator_post_featured_image'),
                    meta: this.api.instance('data_generator_post_meta_data').get()
                }
            );

            request.always(
                function() {
                    (<any>window).LolitaFramework.css_loader.hide();
                }
            );
        }

        /**
         * Generate posts
         * @param {any} e [description]
         */
        deletePosts(e:any) {
            e.preventDefault();

            var request:any;

            if(confirm('Are you sure to delete all posts?') == true) {
                (<any>window).LolitaFramework.css_loader.show(8);

                request = (<any>window).wp.ajax.post(
                    'delete_posts',
                    {
                        nonce: (<any>window).lolita_framework.LF_NONCE,
                        post_type: this.api.instance('data_generator_post_post_type').get()
                    }
                );

                request.always(
                    function() {
                        (<any>window).LolitaFramework.css_loader.hide();
                    }
                );
            }
        }

        /**
         * Get image id
         * @param {string} control_name
         */
        getImageID(control_name:string) {
            var id:number;
            try{
                id = this.api.control('data_generator_post_featured_image').params.attachment.id;
            } catch(err) {
                id = 0;
            }
            return id;
        }
    }
    (<any>window).LolitaFramework.data_generator_post = new DataGeneratorPost();
}