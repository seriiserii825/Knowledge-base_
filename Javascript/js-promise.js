const wringOut = (count) =>
  new Promise((resolve, reject) => {
    if (count > 5000) {
      reject(new Error("Больше не могу отжатсья"));
    } else {
      setTimeout(() => {
        console.log(`отжался ${count} раз`);
        resolve();
      }, count);
    }
  });

const squatting = (count) =>
  new Promise((resolve, reject) => {
    if (count > 5000) {
      reject(new Error("Больше не могу приседать"));
    } else {
      setTimeout(() => {
        console.log(`присел ${count} раз`);
        resolve();
      }, count);
    }
  });

const myTraining = async () => {
  try {
    await wringOut(200000);
    await squatting(200);
  } catch (e) {
    console.log(e, " somethings wrong here");
  }
};

myTraining();
