<template>
    <div class="row ">
        <div class="col-4"></div>
        <div class="col-4">
            <nav aria-label="Page navigation">
                <ul class="pagination text-center">
                    <li><a class="btn btn-default" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1"> << </a></li>
                    <li><a class="btn btn-default" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1"> < </a></li>
                    <li v-for="page in pages">
                        <a class="pagination-link btn btn-default" :class="isCurrentPage(page) ? 'is-current' : ''" @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li><a class="btn btn-default" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page"> > </a></li>
                    <li><a class="btn btn-default" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page"> >> </a></li>
                </ul>

            </nav>
        </div>
        <div class="col-4"></div>
    </div>
</template>

<style>
    .pagination {
        margin-top: 40px;
    }
</style>

<script>
    export default {
        name: "Padinacion",
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>