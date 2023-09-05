import inquirer from "inquirer";
import { exec, spawn } from "child_process";

(async () => {
  try {
    const answers = await getAnswers();
    if (answers.options.includes("nvim")) {
      exec('git log --since="3am" --pretty=tformat:"%s" --reverse', (error, stdout, stderr) => {
        if (error) {
          console.log(`error: ${error.message}`);
          return;
        }
        if (stderr) {
          console.log(`stderr: ${stderr}`);
          return;
        }
        console.log(`stdout: ${stdout}`);
      });
    }
  } catch (err) {
    console.error(
      `There was an error while talking to the API: ${err.message}`,
      err
    );
  }
})();

function getAnswers() {
  return inquirer.prompt([
    {
      name: "options",
      message: "Choose what you want to use:",
      type: "checkbox",
      choices: ["nvim", "clipboard"],
      validate: (options) => {
        if (!options.length) {
          return "Choose at least one of the above, use space to choose the option";
        }

        return true;
      },
    },
  ]);
}
