<template>
    <div>
        <b-table striped hover :items="items.data" :fields="fields">

            <template v-slot:cell(options)="data">

                <edit-item
                    :id="data.item.id"
                    :url="url">
                </edit-item>

                <delete-item
                    :id="data.item.id"
                    :url="url"
                    @deleteRecord="removeRecord">
                </delete-item>

            </template>

        </b-table>

        <div class="overflow-auto">
            <b-pagination-nav :link-gen="linkGen" :number-of-pages="items.last_page"></b-pagination-nav>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            items: {},
            fields: {},
            url: '',
        },
        data() {
            return {
                itemss: this.items,
            };
        },
        methods: {
            pushRecord(record) {
                this.items.push(record);
            },
            removeRecord(id) {
                this.items = this.items.filter((item) => item.id !== id);
            },
            linkGen(pageNum) {
                return pageNum === 1 ? this.items.path : `?page=${pageNum}`
            }
        },
    }
</script>
