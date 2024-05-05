import bodyParser from 'body-parser';
import express from 'express';

import usersRoute from './routes/users';

const app = express()
const port = process.env.PORT || '3000'

app.use(bodyParser.json())

/** Routes */
app.use('/api/users', usersRoute)

app.listen(port)

export default app