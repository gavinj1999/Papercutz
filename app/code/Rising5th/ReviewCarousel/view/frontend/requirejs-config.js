var config = {
    paths: {
        'slick': 'Rising5th_ReviewCarousel/js/slick.min' // Local fallback
    },
    shim: {
        'slick': {
            deps: ['jquery']
        },
    },
    map: {
        '*': {
            'Rising5th_ReviewCarousel/carousel': 'Rising5th_ReviewCarousel/js/carousel'
        }
    }
};