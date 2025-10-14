interface State {
  userId: string;
  pageTitle: string;
  recentFiles: string[];
  pageContents: string;
}

interface TopNavState {
  userId: State["userId"];
  pageTitle: State["pageTitle"];
  recentFiles: State["recentFiles"];
}

type TopNavStateMappedType = {
  [K in "userId" | "pageTitle" | "recentFiles"]: State[K];
};

type TopNavStatePick = Pick<State, 'userId' | 'pageTitle' | 'recentFiles'>;
