function appData() {
    return {
        mobileMenuOpen: false,
    };
}

function searchComponent() {
    return {
        query: '',
        results: [],
        isSearching: false,
        fetchResults() {
            if (this.query.trim().length === 0) {
                this.results = [];
                return;
            }
            this.isSearching = true;
            fetch(`/api/search?query=${this.query}`)
                .then(res => res.json())
                .then(data => {
                    this.results = data;
                    this.isSearching = false;
                });
        }
    };
}
