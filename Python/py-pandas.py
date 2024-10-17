import pandas

data = pandas.read_csv("nato.csv")
nato_dict = {row.letter:row.code for (_, row) in data.iterrows()}

data = pandas.read_csv("50_states.csv")
all_states = data.state.to_list()
# states to learn
guessed_states = []
states_to_learn = [state for state in all_states if state not in guessed_states]
print(f"states_to_learn: {states_to_learn}")

new_data = pandas.DataFrame(states_to_learn)
new_data.to_csv("states_to_learn.csv")
