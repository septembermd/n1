var createSearchChoice = function(term, data) {
    var filter = function() {
        return this.text.localeCompare(term) === 0;
    };
    if ( $(data).filter(filter).length === 0 ) {
        return {id:term, text:term};
    }
};