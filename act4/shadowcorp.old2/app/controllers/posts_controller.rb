class PostsController < ApplicationController                                   
  def index
  end

  def show
  end

  def search
    @posts = Post.find_by_name(params[:name])
    render :json => @posts
  end
end
