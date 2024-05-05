import app from './app';
const port = process.env.PORT || '3000'

app.listen(port, () => {
    console.log(`Anon API listen on port ${port}`)
})