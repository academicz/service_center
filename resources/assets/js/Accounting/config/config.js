const ENV = {
    MAP_API_KEY: 'AIzaSyBMfwS9dLTDJNCUqkhhVpDTHra_zjZYEvo',
    ACCOUNTING: {
        END_POINT: process.env.NODE_ENV === 'production' ? 'http://church.carpinteria.in/json' : 'http://localhost:8000/json',
    },
};

export {
    ENV
};