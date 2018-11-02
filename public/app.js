new Vue({
    el: '#app',
    data: {
        recordsApi: '/api/v13/records',
        currentPage: 1,
        itemsPerPage: 3,
        resultCount: 0,
        records: [],
        errors:[]
    },
    mounted: function () {
        fetch(this.recordsApi)
            .then(res => res.json())
            .then(res => {
                this.records = res;
            })
    },
    methods: {
        createRecord: function () {
            fetch(this.recordsApi, {
                method: 'POST',
                body: new FormData(document.forms.record)
            }).then(() => {
                fetch(this.recordsApi)
                    .then(res => res.json())
                    .then(res => {
                        this.records = res;
                    })
            });
        },
        setPage: function(pageNumber) {
            this.currentPage = pageNumber;
        }
    },
    computed: {
        totalPages: function() {
            return Math.ceil(this.resultCount / this.itemsPerPage);
        },
        paginate: function() {
            let recordsLength = _.size(this.records);

            if (recordsLength <= 0) {
                return;
            }

            this.resultCount = recordsLength;

            if (this.currentPage >= this.totalPages) {
                this.currentPage = this.totalPages;
            }

            let index = this.currentPage * this.itemsPerPage - this.itemsPerPage;

            return Object.entries(this.records).slice(index, index + this.itemsPerPage).map(entry => entry[1]);
        }
    }
});