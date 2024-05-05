import bodyParser from 'body-parser';
import express from 'express';

import usersRoute from './routes/users';

const app = express()

app.use(bodyParser.json())

/** Routes */
app.use('/api/users', usersRoute)

export default app