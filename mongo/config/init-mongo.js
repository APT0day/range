db.getSiblingDB('admin')
    .createUser({
        user: 'test',
        pwd: 'test',
        roles: [{
            role: 'readWrite',
            db: 'pymongodb'
        }]
});
