import bodyParser from 'body-parser';
import express from 'express';

import usersRoute from './routes/users';
import groupsRoute from './routes/groups';
import userGroupsRoute from './routes/userGroups';

const app = express()
const port = process.env.PORT || '3000'

app.use(bodyParser.json())

/** Routes */
app.use('/api/users', usersRoute)
app.use('/api/group', groupsRoute)
app.use('/api/userGroup', userGroupsRoute)

app.listen(port)

export default app