/// <reference path="jquery.d.ts" />

namespace LolitaFramework {
    export class DataGeneratorTerm {

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
                '#sample_data_generator_term_generate',
                (e:any) => this.generateTerms(e)
            );

            jQuery(document).on(
                'click',
                '#sample_data_generator_term_deleta_all',
                (e:any) => this.deleteTerms(e)
            );
        }

        /**
         * Generate posts
         * @param {any} e [description]
         */
        generateTerms(e:any) {
            e.preventDefault();
            console.log('terms generator');

            var request:any;

            (<any>window).LolitaFramework.css_loader.show(8);

            request = (<any>window).wp.ajax.post(
                'generate_terms',
                {
                    nonce: (<any>window).lolita_framework.LF_NONCE,
                    count: this.api.instance('sample_data_generator_term_count').get(),
                    taxonomy: this.api.instance('sample_data_generator_term_taxonomy').get(),
                    title: this.api.instance('sample_data_generator_term_title').get(),
                    description: this.api.instance('sample_data_generator_term_description').get(),
                    meta: this.api.instance('sample_data_generator_term_meta_data').get()
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
        deleteTerms(e:any) {
            e.preventDefault();

            var request:any;

            if(confirm('Are you sure to delete all terms?') == true) {
                (<any>window).LolitaFramework.css_loader.show(8);

                request = (<any>window).wp.ajax.post(
                    'delete_terms',
                    {
                        nonce: (<any>window).lolita_framework.LF_NONCE,
                        taxonomy: this.api.instance('sample_data_generator_term_taxonomy').get()
                    }
                );

                request.always(
                    function() {
                        (<any>window).LolitaFramework.css_loader.hide();
                    }
                );
            }
        }
    }
    (<any>window).LolitaFramework.data_generator_term = new DataGeneratorTerm();
}