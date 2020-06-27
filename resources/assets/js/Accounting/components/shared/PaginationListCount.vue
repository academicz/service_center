<template>
    <div v-if="data.data.length">
        <div class="pages" v-if="data.meta.total>0">
            {{ (data.meta.current_page * data.meta.per_page) - data.meta.per_page + 1}}
            to {{ data.meta.total > data.meta.per_page ? (data.meta.current_page * data.meta.per_page) > data.meta.total ? data.meta.total :
            (data.meta.current_page * data.meta.per_page) : data.meta.total }} out of {{ data.meta.total }} entries
        </div>
    </div>
    <div v-else class="pages">No Results</div>
</template>

<script>
    import * as constants from "../../constants/constants";

    export default {
        name: "PaginationListCount",
        props: {
            data: {
                default: function () {
                    return {
                        meta: {
                            total:0
                        },
                        data: {},
                        links: {}
                    }
                }
            }
        },
    }
</script>

<style scoped>
    .pages {
        margin-bottom: 6px;
    }
</style>