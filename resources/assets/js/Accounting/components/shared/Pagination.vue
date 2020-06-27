<template>
    <div v-if="data.data.length">
        <ul class="pagination" v-if="data.meta.total > data.meta.per_page">
            <li class="page-item pagination-prev-nav" v-if="data.links.prev">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="selectPage(--data.meta.current_page)">
                    <slot name="prev-nav">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </slot>
                </a>
            </li>
            <li class="page-item pagination-page-nav" v-for="n in getPages()" :class="{active: n === data.meta.current_page }">
                <a class="page-link" href="#" @click.prevent="selectPage(n)">{{ n }}</a>
            </li>
            <li class="page-item pagination-next-nav" v-if="data.links.next">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="selectPage(++data.meta.current_page)">
                    <slot name="next-nav">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </slot>
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        name: 'pagination',
        props: {
            data: {
                default: function () {
                    return {
                        meta: {
                            total:0,
                            per_page:10,
                        },
                        data: {},
                        links: {}
                    }
                }
            },
            limit: {
                type: Number,
                default: 0
            },
            formData: {
                default: null
            }
        },
        methods: {
            selectPage: function (page) {

                if (page === '...') {
                    return;
                }

                this.$emit('pagination-change-page', {
                    url: this.getUrl() + page,
                    data: this.formData !== null ? this.formData : null
                });
            },
            getPages: function () {
                this.getUrl();
                if (this.limit === -1) {
                    return 0;
                }

                if (this.limit === 0) {
                    return this.data.meta.last_page;
                }

                var current = this.data.meta.current_page,
                    last = this.data.meta.last_page,
                    delta = this.limit,
                    left = current - delta,
                    right = current + delta + 1,
                    range = [],
                    pages = [],
                    l;

                for (var i = 1; i <= last; i++) {
                    if (i == 1 || i == last || (i >= left && i < right)) {
                        range.push(i);
                    }
                }

                range.forEach(function (i) {
                    if (l) {
                        if (i - l === 2) {
                            pages.push(l + 1);
                        } else if (i - l !== 1) {
                            pages.push('...');
                        }
                    }
                    pages.push(i);
                    l = i;
                });

                return pages;
            },
            getUrl() {
                if (this.data.links.next !== null)
                    return this.data.links.next.slice(0, this.data.links.next.lastIndexOf('&'));
                else
                    return this.data.links.prev.slice(0, this.data.links.prev.lastIndexOf('&'));
            }
        },
    };
</script>