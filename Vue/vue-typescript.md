How to add typescript to Vue 3 and Vite project
I will create a vite project to use typescript step by step:

first, we should create a vite project at first
npm init vite-app <project-name>
cd <project-name>
npm install
second, we should install typescript
npm install typescript
 third, we should create a tsconfig.json file in the root folder, like this:
{
  "compilerOptions": {
    "target": "esnext",
    "module": "esnext",
    "moduleResolution": "node",
    "importHelpers": true,
    "isolatedModules": true,
    "noEmit": true
  }
}
And you can check here, What is a tsconfig.json

then, we sholud create a shims-vue.d.ts file in the src folder, like this:
declare module "*.vue" {
  import { defineComponent } from "vue";
  const Component: ReturnType<typeof defineComponent>;
  export default Component;
}
The shims-vue.d.ts file helps your IDE to understand what a file ending in .vue is.
Now, we can check whether the .ts file works well.
In my case, i rename the main.js file to main.ts in the src folder,
and modify the index.html, 12 line:

 <script type="module" src="/src/main.js"></script> 
to

 <script type="module" src="/src/main.ts"></script> 
At last, run

npm run dev
If there is no error message, you can create your component file by .ts
Good luck!
