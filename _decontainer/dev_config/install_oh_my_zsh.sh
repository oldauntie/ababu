#!/usr/bin/expect -f

set ZSH_THEME "bureau"

puts "🚀 Starting Oh My Zsh setup..."
spawn env ZSH=/home/vscode/zsh
puts "🎨 setting the theme \"$ZSH_THEME\" inside .zshrc..."
spawn sed -i "s/ZSH_THEME=.*/ZSH_THEME=\"$ZSH_THEME\"/" /home/vscode/.zshrc

puts "♻️ Reloading the configuration zsh..."
exec zsh -ic ""
puts "🎉 Oh My Zsh setup complete."
