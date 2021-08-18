export async function getStaticPaths() {
const res = await fetch("https://jsonplaceholder.typicode.com/users");
const users = await res.json();

const paths = users.map((user) => ({
params: { userId: user.id.toString() }
}));

return { paths, fallback: false };
}

export async function getStaticProps({ params }) {
const res = await fetch(
`https://jsonplaceholder.typicode.com/users/${params.userId}`
);
const user = await res.json();

return { props: { user } };
}
